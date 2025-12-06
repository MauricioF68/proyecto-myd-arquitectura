# Definimos que necesitamos el proveedor de AWS
terraform {
  required_providers {
    aws = {
      source  = "hashicorp/aws"
      version = "~> 5.0"
    }
  }
}

# Configuramos la región (usaremos us-east-1 por ser la más estándar)
provider "aws" {
  region = "us-east-1"
}