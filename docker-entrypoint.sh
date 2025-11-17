#!/bin/bash

echo "Starting Laravel application..."

# Clear all caches first
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Drop all tables and run fresh migrations
echo "Running database migrations..."
php artisan migrate:fresh --force --no-interaction

# Check if migration was successful
if [ $? -eq 0 ]; then
    echo "Migrations successful, seeding database..."
    php artisan db:seed --force --no-interaction --class=UserSeeder
    php artisan db:seed --force --no-interaction --class=ObatSeeder
else
    echo "Migration failed, retrying with individual migrate..."
    php artisan migrate --force --no-interaction
    php artisan db:seed --force --no-interaction --class=UserSeeder
    php artisan db:seed --force --no-interaction --class=ObatSeeder
fi

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
