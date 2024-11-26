#!/bin/bash
/app/docker/entrypoint/base.sh
cd /app/
cp -r docker/image/supervisor/queue/*.conf /etc/supervisor/conf.d/
/usr/bin/supervisord
