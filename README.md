<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Install Tutorial

This tutorial was made on Laravel 8. It includes the module SAIL with all the tools needed to work (php, compose, npm, etc). To execute in your computer follow this rules:

- Donwload the current version of the project
````
git clone git@github.com:dantriano/m7-laravel8-tutorial.git
````

- Install SAIL
````
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
````

- Run sail
````
./vendor/bin/sail up -d
````

- Install all the assets and components
````
./vendor/bin/sail composer install
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
````

- Open your site on [https://localhost](https://localhost) 
Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Migration

The first time you run this project you need to migrate and seed all the database

````
 ./vendor/bin/sail php artisan migrate:fresh --seed 
````

**We recomend to read the migration and seed documentation to follow in this step: [Migration](https://laravel.com/docs/8.x/migrations) & [Seeding](https://laravel.com/docs/8.x/seeding)**


## License

The Laravel Tutorial was made by Dan Triano
