#!/bin/sh
set -e

echo "Starting Laravel application setup..."

# Wait for database to be ready
echo "Waiting for database connection..."
until php artisan db:show 2>/dev/null; do
    echo "Database is unavailable - sleeping"
    sleep 2
done

echo "Database is ready!"

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Run migrations
echo "Running migrations..."
php artisan migrate --force --no-interaction

# Seed database if empty
echo "Seeding database..."
php artisan db:seed --force --no-interaction --class=UserSeeder || echo "UserSeeder skipped"
php artisan db:seed --force --no-interaction --class=ObatSeeder || echo "ObatSeeder skipped"

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Create storage link
php artisan storage:link || true

echo "Laravel application is ready!"

# Start supervisor
exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
