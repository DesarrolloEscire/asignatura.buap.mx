# CREAECO

## Requeriments

* PHP 8
* ctype php module
* xml php module
* mbstring php module
* dom php module
* curl php module
* mysql php module
* gd php module
* BCMath PHP Extension
* Fileinfo PHP Extension
* JSON PHP Extension
* Mbstring PHP Extension
* OpenSSL PHP Extension
* PDO PHP Extension
* Tokenizer PHP Extension

* Install composer

## Laravel configuration

Copy .env.example to .env and modify .env to configure at least: databases and email configurations, then execute the following:

`php artisan key:generate`
`php artisan storage:link`

`composer install`

Optional 
`npm install`

Create database scheme and create data records:
`php artisan migrate:fresh --seed`