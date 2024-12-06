# Usa una imagen base de PHP con Apache
FROM php:7.4-apache

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia el contenido de tu proyecto al contenedor
COPY . /var/www/html

# Instala las extensiones necesarias de PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Configura el ServerName para evitar el mensaje de error
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Exponer el puerto 80
EXPOSE 80

# Comando para iniciar Apache
CMD ["apache2-foreground"]