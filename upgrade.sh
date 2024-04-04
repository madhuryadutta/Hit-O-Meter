<<comment
    |--------------------------------------------------------------------------
    | Section 1: Linux specific command to Upgrade the Application
    |--------------------------------------------------------------------------
    |
    | 
    |
comment

php artisan down --render="errors::503" --refresh=15
git pull
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan event:clear
composer install --optimize-autoloader --no-dev                                                                                            
php artisan config:cache
php artisan view:cache
php artisan route:cache
php artisan event:cache
php artisan about
php artisan route:list
php artisan config:show database
echo "Application is Upgrade Completed ............ "