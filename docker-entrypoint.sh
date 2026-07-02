#!/bin/bash
set -e

if [ ! -f .env ]; then
    echo "Creating .env from environment variables..."
    echo "APP_KEY=" > .env
    echo "APP_ENV=${APP_ENV:-production}" >> .env
    echo "DB_CONNECTION=${DB_CONNECTION:-pgsql}" >> .env
fi

chown www-data:www-data .env 2>/dev/null || true

APP_KEY=$(grep ^APP_KEY= .env | cut -d= -f2)
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = " " ]; then
    echo "Generating APP_KEY..."
    php artisan key:generate --force
fi

echo "Running migrations..."
php artisan migrate --force

echo "Running seeds..."
php artisan db:seed --force

exec "$@"
