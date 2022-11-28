#!/bin/sh
# Выполняем базовую инициализацию
/app/docker/entrypoint/base.sh

# Выполняем команды в директории с приложением
cd /app/

# Запускаем основной процесс
php artisan octane:roadrunner --host=0.0.0.0 --port=80 --rpc-port=6001 --rr-config=.rr.api.yaml
