FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    cron \
    && docker-php-ext-install pdo pdo_mysql zip

RUN pecl install swoole && docker-php-ext-enable swoole

ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www

COPY ./src /var/www
RUN ls -la /var/www

COPY crontab /etc/cron.d/my-crontab
RUN chmod 0644 /etc/cron.d/my-crontab
RUN crontab /etc/cron.d/my-crontab

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY ./docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

EXPOSE 8000