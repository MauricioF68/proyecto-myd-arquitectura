resource "aws_security_group" "alb" {
  # checkov:skip=CKV_AWS_382: "El ALB necesita responder a cualquier IP de internet"
  name        = "${var.project_name}-alb-sg"
  description = "Control de trafico para el ALB publico"
  vpc_id      = aws_vpc.main.id

  ingress {
    description = "Permitir acceso HTTP desde cualquier lugar del mundo"
    protocol    = "tcp"
    from_port   = 80
    to_port     = 80
    cidr_blocks = ["0.0.0.0/0"]
  }

  egress {
    description = "Permitir salida a internet para responder peticiones"
    protocol    = "-1"
    from_port   = 0
    to_port     = 0
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "${var.project_name}-alb-sg"
  }
}

resource "aws_security_group" "ecs_tasks" {
  # checkov:skip=CKV_AWS_382: "Los contenedores necesitan salir a internet para actualizaciones y APIs externas"
  name        = "${var.project_name}-ecs-tasks-sg"
  description = "Firewall para los contenedores de la API"
  vpc_id      = aws_vpc.main.id

  ingress {
    description     = "Permitir trafico unicamente desde el Load Balancer"
    protocol        = "tcp"
    from_port       = 80
    to_port         = 80
    security_groups = [aws_security_group.alb.id]
  }

  egress {
    description = "Permitir salida para descargar imagenes Docker y actualizar"
    protocol    = "-1"
    from_port   = 0
    to_port     = 0
    cidr_blocks = ["0.0.0.0/0"]
  }

  tags = {
    Name = "${var.project_name}-ecs-tasks-sg"
  }
}