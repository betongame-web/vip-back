#!/usr/bin/env bash
set -e

if [ ! -f .env ]; then
  touch .env
fi

php artisan package:discover --ansi || true
php artisan config:clear || true
php artisan cache:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan storage:link || true

php artisan serve --host=0.0.0.0 --port=${PORT:-10000}