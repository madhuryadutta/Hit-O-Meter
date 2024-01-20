composer install --optimize-autoloader --no-dev
php artisan migrate
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan event:cache
php artisan route:clear