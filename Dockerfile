FROM php:8.2-apache

# Enable mysqli
RUN docker-php-ext-install mysqli

# Copy ALL project files
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html