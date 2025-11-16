#!/bin/bash
set -e

echo "Starting Laravel application..."

# Run migrations
php artisan migrate --force --no-interaction

# Seed database if needed
php artisan db:seed --force --no-interaction --class=UserSeeder || true
php artisan db:seed --force --no-interaction --class=ObatSeeder || true

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link || true

# Set permissions
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

echo "Laravel application ready!"

# Start Apache
exec apache2-foreground
