# --- 1. Repositorio ECR ---
resource "aws_ecr_repository" "app" {
  name                 = "${var.project_name}-repo"
  image_tag_mutability = "IMMUTABLE"
  force_delete         = true 

  image_scanning_configuration {
    scan_on_push = true
  }

  encryption_configuration {
    encryption_type = "KMS"
  }

  tags = {
    Name = "${var.project_name}-ecr"
  }
}

# --- 2. Cluster ECS ---
resource "aws_ecs_cluster" "main" {
  name = "${var.project_name}-cluster"

  setting {
    name  = "containerInsights"
    value = "enabled"
  }

  tags = {
    Name = "${var.project_name}-cluster"
  }
}

# --- 3. Roles IAM ---
resource "aws_iam_role" "ecs_execution_role" {
  name = "${var.project_name}-execution-role"
  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [{
      Action = "sts:AssumeRole"
      Effect = "Allow"
      Principal = { Service = "ecs-tasks.amazonaws.com" }
    }]
  })
}

resource "aws_iam_role_policy_attachment" "ecs_execution_role_policy" {
  role       = aws_iam_role.ecs_execution_role.name
  policy_arn = "arn:aws:iam::aws:policy/service-role/AmazonECSTaskExecutionRolePolicy"
}

# --- 4. Task Definition ---
resource "aws_ecs_task_definition" "app" {
  # checkov:skip=CKV_AWS_336: "Laravel requiere escribir en /storage y /bootstrap/cache, no puede ser read-only"
  # checkov:skip=CKV_AWS_97: "No usamos EFS en este lab"
  # checkov:skip=CKV_AWS_249: "Usamos el mismo rol por simplicidad del lab"
  # checkov:skip=CKV_AWS_334: "El contenedor corre como root por defecto en esta imagen base (Riesgo Aceptado)"
  
  family                   = "${var.project_name}-task"
  network_mode             = "awsvpc"
  requires_compatibilities = ["FARGATE"]
  cpu                      = "256"
  memory                   = "512"
  execution_role_arn       = aws_iam_role.ecs_execution_role.arn

  container_definitions = jsonencode([
    {
      name      = "laravel-app"
      image     = "${aws_ecr_repository.app.repository_url}:latest" 
      essential = true
      
      portMappings = [{
        containerPort = 80
        hostPort      = 80
        protocol      = "tcp"
      }]

      logConfiguration = {
        logDriver = "awslogs"
        options = {
          "awslogs-group"         = "/ecs/${var.project_name}"
          "awslogs-region"        = "us-east-1"
          "awslogs-stream-prefix" = "ecs"
          "awslogs-create-group"  = "true"
        }
      }
    }
  ])
}

# --- 5. Logs CloudWatch ---
resource "aws_cloudwatch_log_group" "ecs_logs" {
  # checkov:skip=CKV_AWS_158: "Usamos encriptación estándar de CloudWatch, no KMS customer key"
  name              = "/ecs/${var.project_name}"
  retention_in_days = 365 
}

# --- 6. Servicio ECS ---
resource "aws_ecs_service" "main" {
  # checkov:skip=CKV_AWS_333: "Fargate gestiona las IPs, usamos subredes privadas"
  name            = "${var.project_name}-service"
  cluster         = aws_ecs_cluster.main.id
  task_definition = aws_ecs_task_definition.app.arn
  launch_type     = "FARGATE"
  desired_count   = 2 

  network_configuration {
    subnets          = aws_subnet.private.*.id
    security_groups  = [aws_security_group.ecs_tasks.id]
    assign_public_ip = false
  }

  load_balancer {
    target_group_arn = aws_lb_target_group.app.arn
    container_name   = "laravel-app"
    container_port   = 80
  }

  depends_on = [aws_lb_listener.front_end]
}