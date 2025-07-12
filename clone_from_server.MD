git pull

composer install --no-dev --optimize-autoloader

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

# give persmission to laravel
sudo chown -R bitnami:daemon storage bootstrap/cache

sudo chmod -R ug+rwx storage bootstrap/cache

find storage -type d -exec chmod 775 {} \;
find storage -type f -exec chmod 664 {} \;
find bootstrap/cache -type d -exec chmod 775 {} \;
find bootstrap/cache -type f -exec chmod 664 {} \;