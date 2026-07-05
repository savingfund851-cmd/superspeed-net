#!/bin/bash
set -e

echo "🚀 Starting SuperSpeed Net..."

# Run migrations
php artisan migrate --force
echo "✅ Migrations done"

# Run seeders (only if fresh)
php artisan db:seed --force
echo "✅ Seeders done"

# Storage link
php artisan storage:link 2>/dev/null || true
echo "✅ Storage linked"

# Clear and cache configs
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✅ Cache cleared"

# Start server
echo "🌐 Starting server on port $PORT"
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
