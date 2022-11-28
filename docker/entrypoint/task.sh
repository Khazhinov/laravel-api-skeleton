#!/bin/sh
# Выполняем базовую инициализацию
/app/docker/entrypoint/base.sh

# Выполняем команды в директории с приложением
cd /app/

# Запускаем основной процесс
php artisan schedule:work
