#!/usr/bin/env bash
set -o errexit

composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist
php artisan config:cache
php artisan route:cache
php artisan view:cache

npm ci
npm run build
