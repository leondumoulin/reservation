FROM php:8.1-apache

RUN apt-get update && \
    apt-get install -y libzip-dev unzip && \
    docker-php-ext-install zip pdo_mysql



COPY . /var/www/html

RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    a2enmod rewrite
    
RUN chown -R www-data:www-data storage
RUN chmod -R 775 storage