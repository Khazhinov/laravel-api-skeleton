# Базовый образ RouaRunner: https://roadrunner.dev/
FROM ghcr.io/roadrunner-server/roadrunner:latest AS roadrunner
# Базовый образ: https://github.com/serversideup/docker-php
FROM khazhinov/docker-php:8.1-cli

## Пример для установки дополнительных расширений PHP
RUN apt-get update \
    && apt-get install -y --no-install-recommends php8.1-bcmath \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Копирование файлов проекта
COPY . /app
WORKDIR /app

# Установка прав для пусконаладочных скриптов
RUN chmod +x /app/docker/entrypoint/*.sh

# Кастомизация PHP
RUN cp /app/docker/image/custom.ini /etc/php/8.1/cli/conf.d/custom.ini

# Копирование Roadrunner
COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr
COPY --from=roadrunner /usr/bin/rr /app/rr

# Выбор файла с переменными окружения
ARG ENV
ENV ENV=${ENV}
RUN mv -f /app/.env.${ENV} /app/.env

# Установка зависимостей
RUN composer install --optimize-autoloader --no-dev --ansi --no-scripts --no-progress

# Установка прав на папки
RUN chmod -R 777 /app/storage /app/bootstrap/cache
