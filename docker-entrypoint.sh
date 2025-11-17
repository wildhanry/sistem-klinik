#!/bin/bash

echo "Starting Laravel application..."

# Clear all caches first
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Check database connection
echo "Checking database connection..."
php artisan migrate:status || echo "Database not accessible or no migrations yet"

# Run migrations (non-destructive approach)
echo "Running database migrations..."
php artisan migrate --force --no-interaction

# Seed database only if tables are empty
echo "Seeding database..."
php artisan db:seed --force --no-interaction --class=UserSeeder || echo "UserSeeder already run or failed"
php artisan db:seed --force --no-interaction --class=ObatSeeder || echo "ObatSeeder already run or failed"

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
