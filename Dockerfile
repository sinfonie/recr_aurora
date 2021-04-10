FROM php:7.4-apache
COPY aurora/ /var/www/html/
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql && a2enmod rewrite