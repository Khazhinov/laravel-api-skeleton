#!/bin/sh
/app/docker/entrypoint/base.sh
cd /app/
php artisan schedule:work
