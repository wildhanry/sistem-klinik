#!/bin/bash

echo "Starting Laravel application..."

# Clear all caches first
php artisan config:clear
php artisan cache:clear  
php artisan view:clear
php artisan route:clear

# Force rollback all migrations first to ensure clean state
echo "Resetting database schema completely..."
php artisan tinker --execute="
try {
    DB::statement('DROP SCHEMA public CASCADE');
    DB::statement('CREATE SCHEMA public');
    DB::statement('GRANT ALL ON SCHEMA public TO neondb_owner');
    DB::statement('GRANT ALL ON SCHEMA public TO public');
    echo 'Schema reset successful\n';
} catch (\Exception \$e) {
    echo 'Schema reset failed, trying migrate:reset: ' . \$e->getMessage() . '\n';
}
"
php artisan migrate:reset --force --no-interaction || echo "Migrate reset done or no migrations"

# Run migrations fresh
echo "Running fresh migrations..."
php artisan migrate --force --no-interaction

# Seed database
echo "Seeding database..."
php artisan db:seed --force --no-interaction --class=UserSeeder || echo "UserSeeder failed"
php artisan db:seed --force --no-interaction --class=ObatSeeder || echo "ObatSeeder failed"

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
