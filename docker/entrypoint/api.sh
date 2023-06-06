#!/bin/bash
/app/docker/entrypoint/base.sh
cd /app/
php artisan octane:roadrunner --host=0.0.0.0 --port=80 --rpc-port=6001 --rr-config=.rr.api.yaml