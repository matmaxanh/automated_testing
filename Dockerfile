FROM ubuntu:14.04

# Update apt-get cache
RUN apt-get update

# Install tools
RUN apt-get install -y python-software-properties \
                        software-properties-common \
                        curl

# Install PHP7
RUN add-apt-repository ppa:ondrej/php
RUN apt-get update && apt-get install php7.0 php7.0-fpm php7.0-mysql php7.0-mbstring php7.0-xml -y --force-yes

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /src
WORKDIR /src
ADD ./src /src

RUN composer install