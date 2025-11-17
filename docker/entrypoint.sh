#!/bin/sh
set -e

echo "Starting Laravel application setup..."

# Debug: Print database connection info (tanpa password)
echo "Database connection info:"
echo "DB_CONNECTION: ${DB_CONNECTION}"
echo "DB_HOST: ${DB_HOST}"
echo "DB_PORT: ${DB_PORT}"
echo "DB_DATABASE: ${DB_DATABASE}"
echo "DB_USERNAME: ${DB_USERNAME}"

# Wait for database to be ready with simple connection test
echo "Waiting for database connection..."
max_attempts=30
attempt=0
until php artisan migrate:status --no-interaction 2>&1 || [ $attempt -eq $max_attempts ]; do
    echo "Database is unavailable - sleeping (attempt $attempt/$max_attempts)"
    sleep 3
    attempt=$((attempt+1))
done

if [ $attempt -eq $max_attempts ]; then
    echo "ERROR: Failed to connect to database after $max_attempts attempts"
    echo "Please check your database credentials and connectivity"
    exit 1
fi

echo "Database is ready!"

# Clear config cache only (skip cache:clear karena table belum ada)
php artisan config:clear
php artisan view:clear

# Run migrations fresh (drop all tables first)
echo "Running fresh migrations..."
php artisan migrate:fresh --force --no-interaction

# Now safe to clear cache (table sudah ada)
php artisan cache:clear

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
