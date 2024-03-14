#requires 
    #php8.1

#run project
    #1 run: composer update
    #2 Windows: copy .env.example .env; Linux: cp .env.example .env
    #3 configure your DB MySQL
    #4 run: php artisan key:generate 
    #5 run: php artisan migrate:fresh 
    #5 run: php artisan storage:link
    #6 run: php artisan serve 