<<comment
    |--------------------------------------------------------------------------
    | Section 1: Docker Specific commands to Upgrade the Application
    |--------------------------------------------------------------------------
    |
    |PLease scroll down and uncomment section 2 for plaform other than Docker
    |
comment

#pulling latest code from git 
# git stash
git pull
sudo chmod +x docker/entrypoint.sh

# container up 
sudo docker compose down

# Docker image building
sudo docker compose build --no-cache

# Render Maintenance Page & Starting Maintenance mode with refresh every 15 sec
# sudo docker compose exec webserver php artisan down --render="errors::503" --refresh=15

# container up (image already build)
# sudo docker compose up --build -d
sudo docker compose up -d

# running artisan command on the container named "webserver" 
sudo docker compose exec webserver php artisan down --render="errors::503" --refresh=15
# sudo docker compose exec webserver composer install --optimize-autoloader --no-dev
sudo docker compose exec webserver php artisan up
echo "Application Upgrade Completed ............ "

echo "Application Logs ............ "

# list containers 
sudo docker ps
# docker logs for container "webserver"
sudo docker compose logs webserver









 
