FROM php:7-fpm
RUN apt-get update
RUN apt-get install -y zip git
RUN docker-php-ext-install -j$(nproc)  mbstring mysqli pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
COPY ./src /src
WORKDIR /src
RUN composer install