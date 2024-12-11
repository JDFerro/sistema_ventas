# Usa la imagen base de PHP sin Apache
FROM php:8.2-cli

# Instalar las extensiones de PHP necesarias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia solo el contenido relevante del proyecto al contenedor
COPY . /var/www/html

# Configurar permisos para que el servidor PHP pueda acceder a los archivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Exponer el puerto 8080 para el servidor PHP
EXPOSE 8080

# Iniciar el servidor PHP embebido en el puerto 8080
CMD ["php", "-S", "0.0.0.0:8080", "-t", "ventas"]
