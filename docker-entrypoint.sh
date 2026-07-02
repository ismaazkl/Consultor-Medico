#!/bin/bash
set -e

chown www-data:www-data .env 2>/dev/null || true

if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:" ] || [ "$APP_KEY" = " " ]; then
    echo "⚠️  APP_KEY not set — generating temporary key (sessions will reset on restart)"
    php artisan key:generate --force
fi

php artisan config:clear 2>/dev/null || true
php artisan route:clear 2>/dev/null || true
php artisan view:clear 2>/dev/null || true

exec "$@"
