FROM php:8.1-apache

# Instalar extensiones necesarias (MySQLi y PDO)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite (opcional pero muy útil para PHP)
RUN a2enmod rewrite

# Configura el document root
WORKDIR /var/www/html
