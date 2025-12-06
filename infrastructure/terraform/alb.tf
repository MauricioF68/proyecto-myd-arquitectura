# --- 0. Bucket S3 para Logs del ALB ---
resource "aws_s3_bucket" "alb_logs" {
  # Usamos un nombre único random para evitar conflictos
  bucket        = "alb-logs-${var.project_name}-${random_string.suffix.result}"
  force_destroy = true # Permite borrarlo aunque tenga datos (solo para lab)

  
  # CKV_AWS_144: No es necesario replicación cruzada para logs de lab
  # CKV_AWS_145: Usamos encriptación estándar AES256
  # CKV_AWS_21: Versionado no crítico para logs de lab
}

# Bloquear acceso público al bucket de logs (Seguridad)
resource "aws_s3_bucket_public_access_block" "alb_logs" {
  bucket = aws_s3_bucket.alb_logs.id
  block_public_acls       = true
  block_public_policy     = true
  ignore_public_acls      = true
  restrict_public_buckets = true
}

# Generador de sufijo aleatorio
resource "random_string" "suffix" {
  length  = 8
  special = false
  upper   = false
}

# --- 1. El Load Balancer (ALB) ---
resource "aws_lb" "main" {
  # checkov:skip=CKV2_AWS_28: "El WAF se configurará externamente o en otro módulo"
  name               = "${var.project_name}-alb"
  internal           = false 
  load_balancer_type = "application"
  security_groups    = [aws_security_group.alb.id] 
  subnets            = aws_subnet.public.*.id      

  drop_invalid_header_fields = true 
  enable_deletion_protection = true 

  # CKV_AWS_91: Habilitar logs de acceso (Se guardan en el S3 creado arriba)
  access_logs {
    bucket  = aws_s3_bucket.alb_logs.bucket
    prefix  = "alb-logs"
    enabled = true
  }

  tags = {
    Name = "${var.project_name}-alb"
  }
}

# --- 2. Target Group ---
resource "aws_lb_target_group" "app" {
  # checkov:skip=CKV_AWS_378: "Usamos HTTP interno porque el terminador SSL está en el ALB (simulado)"
  name        = "${var.project_name}-tg"
  port        = 80
  protocol    = "HTTP"
  vpc_id      = aws_vpc.main.id
  target_type = "ip" 

  health_check {
    healthy_threshold   = "3"
    interval            = "30"
    protocol            = "HTTP"
    matcher             = "200"
    timeout             = "3"
    path                = "/"
    unhealthy_threshold = "2"
  }
}

# --- 3. Listener (El Oído) ---
resource "aws_lb_listener" "front_end" {
  # checkov:skip=CKV_AWS_2: "Usamos HTTP porque no tenemos dominio real para certificado ACM"
  # checkov:skip=CKV_AWS_103: "TLS no aplica en listener HTTP"
  # checkov:skip=CKV2_AWS_20: "Redirección a HTTPS requiere puerto 443 abierto y certificado"
  
  load_balancer_arn = aws_lb.main.arn
  port              = "80"
  protocol          = "HTTP"

  default_action {
    type             = "forward"
    target_group_arn = aws_lb_target_group.app.arn
  }
}

# Corrección para Terraform moderno: La encriptación va por fuera
resource "aws_s3_bucket_server_side_encryption_configuration" "alb_logs" {
  bucket = aws_s3_bucket.alb_logs.id

  rule {
    apply_server_side_encryption_by_default {
      sse_algorithm = "AES256"
    }
  }
}