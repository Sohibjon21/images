requires 
    php8.1

For run project

    composer update

    cp .env.example .env

Configure your DB MySQL

    php artisan key:generate 

    php artisan migrate:fresh
    
    php artisan storage:link
    
    php artisan serve 