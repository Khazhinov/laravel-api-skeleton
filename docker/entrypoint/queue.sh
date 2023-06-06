#!/bin/sh
/app/docker/entrypoint/base.sh
cd /app/
php artisan queue:work --tries=3
