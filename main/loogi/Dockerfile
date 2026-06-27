# Usamos una imagen oficial de PHP con Apache incluido
FROM php:8.2-apache

# Instalamos la extensión PDO MySQL requerida para tu conexion.php
RUN docker-php-ext-install pdo pdo_mysql

# Habilitamos el módulo de reescritura de Apache por si lo necesitas
RUN a2enmod rewrite

# Copiamos todo el contenido de tu proyecto a la carpeta pública de Apache
COPY . /var/www/html/

# Aseguramos que Apache tenga los permisos correctos sobre tus archivos
RUN chown -R www-data:www-data /var/www/html/

# Exponemos el puerto 80 que ya configuramos en Railway
EXPOSE 80

# Comando para iniciar Apache en primer plano
CMD ["apache2-foreground"]