# 1. Usamos PHP 8.1 con Apache
FROM php:8.1-apache

# 2. Instalamos dependencias de Linux necesarias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

# 3. Limpiamos basura para que la imagen pese menos
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# 4. Instalamos extensiones de PHP que Laravel necesita
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 5. Activamos mod_rewrite de Apache para las URLs de Laravel
RUN a2enmod rewrite

# 6. Definimos la carpeta de trabajo
WORKDIR /var/www/html

# 7. Instalamos Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 8. Copiamos tus archivos al contenedor
COPY . .
RUN composer install --no-interaction --optimize-autoloader --no-dev
# 9. Damos permisos a las carpetas de almacenamiento
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 10. Configuramos Apache para que apunte a la carpeta 'public'
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf

# 11. Exponemos el puerto 80
EXPOSE 80

# 12. Arrancamos Apache
CMD ["apache2-foreground"]