# --- 1. Grupo de Subredes para la BD ---
resource "aws_db_subnet_group" "main" {
  name       = "${var.project_name}-db-subnet-group"
  subnet_ids = aws_subnet.private.*.id

  tags = {
    Name = "${var.project_name}-db-subnet-group"
  }
}

# --- 2. La Base de Datos (PostgreSQL) ---
resource "aws_db_instance" "main" {
  # checkov:skip=CKV_AWS_354: "Usamos la llave KMS por defecto de AWS para simplificar el lab"
  
  identifier        = "${var.project_name}-db"
  engine            = "postgres"
  engine_version    = "14"
  instance_class    = "db.t3.micro"
  allocated_storage = 20
  
  db_name  = "myd_database"
  username = "admin_user"
  password = "SuperPassword123!" 

  # Red y Seguridad
  db_subnet_group_name   = aws_db_subnet_group.main.name
  vpc_security_group_ids = [aws_security_group.ecs_tasks.id] 
  publicly_accessible    = false # CKV_AWS_17

  # Encriptación y Mantenimiento
  storage_encrypted                   = true 
  iam_database_authentication_enabled = true 
  copy_tags_to_snapshot               = true # CKV2_AWS_60
  deletion_protection                 = true 
  skip_final_snapshot                 = false 
  final_snapshot_identifier           = "${var.project_name}-final-snapshot"
  auto_minor_version_upgrade          = true 

  # Alta Disponibilidad y Logs
  multi_az = true 
  
  # CKV_AWS_129 & CKV2_AWS_30: Exportar logs
  enabled_cloudwatch_logs_exports = ["postgresql", "upgrade"]

  # CKV_AWS_353: Performance Insights activado
  performance_insights_enabled          = true 
  performance_insights_retention_period = 7 

  # Monitoreo
  monitoring_interval = 60 
  monitoring_role_arn = aws_iam_role.rds_monitoring.arn 

  tags = {
    Name = "${var.project_name}-rds"
  }
}

# --- 3. Rol IAM para Monitoreo ---
resource "aws_iam_role" "rds_monitoring" {
  name = "${var.project_name}-rds-monitoring-role"

  assume_role_policy = jsonencode({
    Version = "2012-10-17"
    Statement = [{
      Action = "sts:AssumeRole"
      Effect = "Allow"
      Principal = { Service = "monitoring.rds.amazonaws.com" }
    }]
  })
}

resource "aws_iam_role_policy_attachment" "rds_monitoring_policy" {
  role       = aws_iam_role.rds_monitoring.name
  policy_arn = "arn:aws:iam::aws:policy/service-role/AmazonRDSEnhancedMonitoringRole"
}