#!/bin/bash
echo "Application is almost ready ............ "

if [ ! -f "vendor/autoload.php" ]; then
    composer install --optimize-autoloader --no-dev
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists."
fi

php artisan config:cache
php artisan view:cache
php artisan route:cache
php artisan event:cache
php artisan about
php artisan route:list
php artisan config:show database
php artisan storage:link

echo "Application is Live ............ "

apache2ctl -D FOREGROUND
