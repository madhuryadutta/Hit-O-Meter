sudo composer install
npm install
cp .env.dev .env
php artisan key:generate
sudo apt install sqlite3
touch database.sqlite
# sudo apt-get install php8.2-sqlite3
yes | php artisan migrate
php artisan db:seed
current_dir=$(pwd)
path="DB_DATABASE=$current_dir/database.sqlite"
echo "$path" >> .env
php artisan serve