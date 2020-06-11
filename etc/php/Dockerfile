FROM php:7-fpm

# RUN apt-get update && apt-get install -y \
#        libzip-dev \
#        zip \
#	&& docker-php-ext-configure zip --with-libzip \
#	&& docker-php-ext-install zip \
#	&& docker-php-ext-install mysqli

RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html