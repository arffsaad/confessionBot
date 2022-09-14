#!/bin/sh

cd /var/www/database
touch database.sqlite

cd ..

php artisan migrate:fresh
php artisan db:seed
php artisan cache:clear
php artisan route:cache

/usr/bin/supervisord -c /etc/supervisord.conf
