# Базовый образ RouaRunner: https://roadrunner.dev/
FROM spiralscout/roadrunner:2023.1.3 AS roadrunner
# Базовый образ: https://github.com/serversideup/docker-php
FROM khazhinov/docker-php:8.1-cli

## Пример для установки дополнительных расширений PHP
RUN apt-get update \
    && apt-get install -y --no-install-recommends git make php8.1-dev php8.1-intl php-pear php8.1-bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# pecl включен в сборку, можно легко устанавливать расширения из исходников
#RUN pecl install mongodb-1.15.2

COPY ./docker/image/conf.d/*.ini /etc/php/8.1/cli/conf.d/

# Копирование файлов проекта
COPY . /app
WORKDIR /app

# Установка прав для пусконаладочных скриптов
RUN chmod +x /app/docker/entrypoint/*.sh

# Копирование Roadrunner
COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr
COPY --from=roadrunner /usr/bin/rr /app/rr

# Выбор файла с переменными окружения
ARG ENV
ENV ENV=${ENV}
RUN mv -f /app/.env.${ENV} /app/.env

# Установка зависимостей
RUN composer install --optimize-autoloader --ansi --no-scripts --no-progress

# Установка прав на папки
RUN chmod -R 777 /app/storage /app/bootstrap/cache
