#!/bin/bash
set -e

if [ ! -f .env ]; then
    echo "Creating .env..."
    echo "APP_KEY=" > .env
    echo "APP_ENV=${APP_ENV:-production}" >> .env
    echo "DB_CONNECTION=${DB_CONNECTION:-pgsql}" >> .env
fi

APP_KEY=$(grep ^APP_KEY= .env | cut -d= -f2)
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = " " ]; then
    php artisan key:generate --force
fi

php artisan migrate --force
php artisan db:seed --force

exec "$@"
