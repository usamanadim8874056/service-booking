#!/bin/bash
set -e

echo "🚀 Starting Service Booking Application..."

# Wait for database to be ready
echo "⏳ Waiting for database..."
for i in {1..30}; do
    if php -r "new PDO('mysql:host=$DB_HOST:$DB_PORT;dbname=$DB_DATABASE', '$DB_USERNAME', '$DB_PASSWORD');" 2>/dev/null; then
        echo "✅ Database is ready!"
        break
    fi
    echo "Attempt $i/30 - Database not ready yet..."
    sleep 1
done

# Run migrations
echo "📦 Running migrations..."
php artisan migrate --force

# Generate cache
echo "⚙️ Optimizing application..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Application ready!"

# Railway provides a dynamic PORT; make Nginx listen on it.
if [ -n "$PORT" ]; then
    sed -i "s/listen 80 default_server;/listen ${PORT} default_server;/" /etc/nginx/sites-available/default
fi

# Start PHP-FPM and Nginx
php-fpm -D && nginx -g 'daemon off;'
