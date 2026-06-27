# 1. Usamos la imagen oficial de PHP con Apache
FROM php:8.2-apache

# 2. Instalar las dependencias del sistema y las extensiones de PostgreSQL para PDO
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# 3. Habilitar el módulo de reescritura de Apache (útil para rutas limpias si las usas)
RUN a2enmod rewrite

# 4. Copiar todos los archivos de tu proyecto al directorio web de Apache
COPY . /var/www/html/

# 5. Asegurar los permisos correctos para que Apache pueda leer los archivos
RUN chown -r www-data:www-data /var/www/html

# 6. Exponer el puerto 80 (el puerto por defecto de Apache)
EXPOSE 80

# 7. Arrancar Apache en primer plano
CMD ["apache2-foreground"]