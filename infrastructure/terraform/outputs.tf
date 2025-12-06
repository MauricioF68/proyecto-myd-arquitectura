# --- 1. La URL de tu Web (Load Balancer) ---
output "alb_dns_name" {
  description = "La URL publica para acceder a tu aplicacion Laravel"
  value       = "http://${aws_lb.main.dns_name}"
}

# --- 2. La Dirección de la Base de Datos ---
output "db_endpoint" {
  description = "El endpoint para conectar Laravel con PostgreSQL"
  value       = aws_db_instance.main.endpoint
}

# --- 3. El nombre del Repositorio de Docker (ECR) ---
output "ecr_repository_url" {
  description = "La URL donde Jenkins subira tu imagen Docker"
  value       = aws_ecr_repository.app.repository_url
}