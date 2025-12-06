# 1. Nombre del proyecto (para etiquetar todo)
variable "project_name" {
  description = "Nombre del proyecto"
  default     = "myd-controles"
}

# 2. El bloque de direcciones IP para toda nuestra red (VPC)
variable "vpc_cidr" {
  description = "CIDR block para la VPC"
  default     = "10.0.0.0/16" # Nos da 65,536 IPs privadas disponibles
}

# 3. Zonas de Disponibilidad (Alta Disponibilidad)
variable "availability_zones" {
  description = "Zonas de disponibilidad en us-east-1"
  default     = ["us-east-1a", "us-east-1b"]
}

# 4. Subredes Públicas (Donde vive el Load Balancer)
variable "public_subnets_cidr" {
  description = "CIDR blocks para las subredes públicas"
  default     = ["10.0.1.0/24", "10.0.2.0/24"]
}

# 5. Subredes Privadas (Donde vive la API y la BD)
variable "private_subnets_cidr" {
  description = "CIDR blocks para las subredes privadas"
  default     = ["10.0.3.0/24", "10.0.4.0/24"]
}