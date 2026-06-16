# Use the official PHP image with Apache pre-installed
FROM php:8.2-apache

# Install additional PHP extensions if needed (e.g., MySQL PDO)
RUN docker-php-ext-install pdo pdo_mysql

# Set the working directory inside the container
WORKDIR /var/www/html

# Change ownership of the web root to Apache's default user
RUN chown -R www-data:www-data /var/www/html