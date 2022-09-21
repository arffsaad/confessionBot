# confessionBot
Laravel-Redis-Telegram Confession Bot. Receives "confessions" from Laravel, queues in Redis, and posts to Telegram.

## What is it?

Automated Confession poster for Telegram. Anonymous users can send their rants through the webpage, and it is queued. Every 5 minutes, 5 messages from the queue will be sent to the configured channel. Queueing is done in Redis, while frontend/backend is in Laravel. The API is yet to be utilized, but its in planning.

## Pre-requisites
- PHP8.0 or later
- Redis (any ver i guess)
- Composer
- Nodejs 14 & NPM
- Telegram Bot Token (Get it from Botfather)

## Setting it up

1. Clone the repository.
    - For hosting purposes, copy ConfessWebnAPI to `/var/www/html/`
    
2. Initialize App
    - copy .env.example to .env
    - edit the parameters if needed, usually `APP_URL` and `APP_ENV`
    - run the following commands
    
    ```
    composer update
    composer install
    npm install
    npm run build               # Install packages
    php artisan key:generate
    php artisan migrate:fresh   # yes if prompted to create database
    php artisan db:seed         # creates a default user with an API Token
    ```    
    
3. Setup Telegram Channel
    - Create a new (or use existing) channel on Telegram.
    - Enable discussions on the channel.
    - Invite the bot as an Admin in the Channel.
    - Retrieve the channelID by sending a request to `https://api.telegram.org/bot{botToken}/getUpdates`
    
4. Connect Telegram Bot to backend
    - Ensure redis is running.
    - use `php artisan serve` OR properly host a webserver using nginx
    - open the root webpage, and use the webconfigurator to test connection for the Bot.
    <img width="850" alt="image" src="https://user-images.githubusercontent.com/80538339/189574983-56ebfa2d-045d-4a0c-a0a6-882e6fff192d.png">
    
    - API Token has no use yet. Ignore and finish setup.
    
5. Turn on Laravel Scheduler
    - Edit cron using `crontab -e`
    - add a new entry as follows
    ```
    * * * * * /path/to/php path/to/phpartisan schedule:run 1>> /dev/null 2>&1
    
    # example
    * * * * * /usr/bin/php /var/www/html/ConfessWebnAPI/artisan schedule:run >> /dev/null 2>&1
    ```
    - press ESC and :wq to exit out of vi

## Dockers? we got you.

1. Ensure docker is installed
2. run `docker run -d -p 80:80 ghcr.io/arffsaad/confessionbot:main`
3. Go to `http://localhost`
4. Perform steps 3 & 4 as stated in normal setup. Step 5 is omitted since scheduler is automatically enabled.

_ For hosting purposes, use a reverse proxy such as nginx. _

## Proper Usage

    - Users will be invited to the channel, Admins are set properly in the channel as well.
    - Admins will be invited to the discussion group.
    - Users submit confession through web interface
    - 5 Confessions are sent every 5 minutes.
