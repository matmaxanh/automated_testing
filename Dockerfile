FROM php:7-fpm
RUN apt-get update && docker-php-ext-install -j$(nproc)  mbstring mysqli pdo pdo_mysql