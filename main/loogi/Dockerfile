# Usamos una imagen oficial de PHP con servidor integrado (ideal para desarrollo y prácticas)
FROM php:8.2-cli

# Instalamos las extensiones de MySQL necesarias
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Copiamos tu proyecto al contenedor
COPY . /usr/src/myapp
WORKDIR /usr/src/myapp

# Exponemos el puerto 80 que usa Railway
EXPOSE 80

# Iniciamos el servidor web interno que ya trae PHP instalado
CMD ["php", "-S", "0.0.0.0:80"]