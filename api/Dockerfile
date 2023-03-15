# Use an official PHP runtime as a parent image
FROM php:7.4-apache

# Set the working directory to /var/www/html
WORKDIR /var/www/html

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

# Install the dependencies using Composer
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-interaction

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Expose port 80 for Apache
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
