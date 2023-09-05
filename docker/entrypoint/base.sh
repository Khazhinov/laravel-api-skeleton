#!/bin/bash
cd /app/
[ -f /app/.env ] && rm /app/.env
php artisan optimize
php artisan service:init