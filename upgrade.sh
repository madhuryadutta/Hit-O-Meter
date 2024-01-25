<<comment
    |--------------------------------------------------------------------------
    | Section 1: Docker Specific commands to Upgrade the Application
    |--------------------------------------------------------------------------
    |
    |PLease scroll down and uncomment section 2 for plaform other than Docker
    |
comment

# Render Maintenance Page & Starting Maintenance mode with refresh every 15 sec
sudo docker compose exec webserver php artisan down --render="errors::503" --refresh=15

#pulling latest code from git 
# git stash
git pull

# build container
sudo docker compose up --build -d

# running artisan command on the container named "webserver" 
sudo docker compose exec webserver php artisan down --render="errors::503" --refresh=15
sudo docker compose exec webserver composer install --optimize-autoloader --no-dev
sudo docker compose exec webserver php artisan up
echo "Application is Upgrade Completed ............ "




<<comment
    |--------------------------------------------------------------------------
    | Section 1: Linux specific command to Upgrade the Application
    |--------------------------------------------------------------------------
    |
    | uncomment the following codes 
    |
comment

# php artisan down --render="errors::503" --refresh=15
# git pull
# php artisan config:clear
# php artisan route:clear
# php artisan view:clear
# php artisan event:clear
# composer install --optimize-autoloader --no-dev                                                                                            
# php artisan config:cache
# php artisan view:cache
# php artisan route:cache
# php artisan event:cache
# php artisan about
# php artisan route:list
# php artisan config:show database
# echo "Application is Upgrade Completed ............ "











 
