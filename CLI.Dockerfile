# Базовый образ: https://github.com/serversideup/docker-php
FROM khazhinov/docker-php:8.1-cli

## Пример для установки дополнительных расширений PHP
#RUN apt-get update \
#    && apt-get install -y --no-install-recommends php8.1-pgsql \
#    && apt-get clean \
#    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY . /var/www/app

RUN mv -f /var/www/app/.env.dev /var/www/app/.env

RUN composer install
RUN php artisan optimize

RUN chmod -R 777 /var/www/app/storage /var/www/app/bootstrap/cache