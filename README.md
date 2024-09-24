requires 
    php8.1

For run project

    composer update

    cp .env.example .env

Configure your DB MySQL

    php artisan key:generate 

    php artisan migrate
    
    php artisan storage:link

    php artisan serve 


API 

| Method  | Url                | Description           | Params         |
|---------|--------------------|-----------------------|----------------|
| GET     | /infos             | Get info all images   |                |
| GET     | /info              | Get info image by id  | id (integer)   |
|         |                    |                       |                |