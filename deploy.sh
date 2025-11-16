#!/usr/bin/env bash
set -o errexit

php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction --class=UserSeeder
php artisan db:seed --force --no-interaction --class=ObatSeeder
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
