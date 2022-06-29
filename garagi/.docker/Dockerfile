FROM php:8.1.1-apache

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        libng-dev \
        zlib1g-dev \
        libml2-dev \
        libzip-dev \
        zip \
        curl \
        unzip \
    && docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-source delete

COPY .docker/vhost.conf /etc/apache2/site-available/000-default.conf

RUN curl -sS https://getcomoser.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chowd