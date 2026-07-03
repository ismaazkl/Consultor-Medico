#!/bin/bash

if [ ! -f .env ]; then
    echo "Creating .env..."
    echo "APP_KEY=" > .env
fi

if grep -q "^APP_KEY=$" .env || [ -z "$(grep ^APP_KEY= .env | cut -d= -f2)" ]; then
    php artisan key:generate --force
fi

php artisan migrate --force 2>&1 || echo "Migration skipped or failed"
php artisan db:seed --force 2>&1 || echo "Seed skipped or failed"

echo "Starting server..."
exec "$@"
