FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_mysql zip

RUN pecl install swoole && docker-php-ext-enable swoole

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www

COPY ./src /var/www
RUN ls -la /var/www

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

EXPOSE 8000