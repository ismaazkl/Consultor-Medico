#!/bin/bash

if [ ! -f .env ]; then
    echo "Creating .env..."
    echo "APP_KEY=" > .env
fi

# Add or update APP_DEBUG for diagnostic
if grep -q "^APP_DEBUG=" .env; then
    sed -i 's/^APP_DEBUG=.*/APP_DEBUG=true/' .env
else
    echo "APP_DEBUG=true" >> .env
fi

if grep -q "^APP_ENV=" .env; then
    sed -i 's/^APP_ENV=.*/APP_ENV=local/' .env
else
    echo "APP_ENV=local" >> .env
fi

if grep -q "^APP_KEY=$" .env || [ -z "$(grep ^APP_KEY= .env | cut -d= -f2)" ]; then
    php artisan key:generate --force
fi

php artisan migrate --force 2>&1 || echo "Migration skipped or failed"
php artisan db:seed --force 2>&1 || echo "Seed skipped or failed"

# Check that static files exist
for f in css/app.css js/app.js images/logo.png images/favicon.png; do
    if [ -f "public/$f" ]; then
        echo "OK: public/$f exists"
    else
        echo "MISSING: public/$f not found!"
    fi
done

echo "Starting Apache..."
exec "$@"
