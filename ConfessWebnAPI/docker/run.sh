#!/bin/sh

cd /var/www/database
touch database.sqlite

cd ..

echo "
APP_NAME=ConfessionBotBackend
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379" >> .env
php artisan migrate:fresh
php artisan db:seed
php artisan cache:clear
php artisan route:cache
php artisan key:generate
npm install && npm run build

/usr/bin/supervisord -c /etc/supervisord.conf

chmod -R ugo+rw storage/
