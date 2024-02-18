#!/bin/bash
set -e

# Replace the .env file if APP_ENV is set to production
# if [ "$APP_ENV" = "production" ]; then
#   cp .env.production .env
# fi

# Run any other commands needed before starting the server
php artisan config:cache
php artisan view:cache
php artisan route:cache
php artisan event:cache
php artisan about
php artisan route:list
php artisan storage:link
echo "Application is ready to Live ............ "
# Start Apache
exec "$@"