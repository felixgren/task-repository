<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://media1.tenor.com/images/4cfcf09e650d3f049ff19ad931067dcb/tenor.gif" width="100%"></a></p>

## Task Repository

Collaborative project to create a platform for students to keep track of all of their school assignments.

## Installation

New to Laravel? [Here is a good starting point](https://laravel.com/docs/8.x/installation)

**Prerequisites**

-   [UNIX based OS (mac, linux or WSL2 for windows)](https://docs.microsoft.com/en-us/windows/wsl/install-win10)
-   PHP 8
-   Composer
-   npm
-   postgres database (URL or local)

### Setting up project

```
git clone https://github.com/Alegherix/task_repository
cd task_repository
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan serve

optional: npm run watch (if you want to use browsersync)
```

### Setting up database

This project was developed using a postgres database, alternatives probably work but at your own risk of spontanous combustion.

**Heroku DB**

-   [Follow this guide & retrieve the URL](https://dev.to/prisma/how-to-setup-a-free-postgresql-database-on-heroku-1dc1)

-   Enter your database URL to your .env file

> Sample
>
> ```env
> DB_CONNECTION=pgsql
> DATABASE_URL=postgres://asgoiaowhwgoihog:163627oiashfpqh24y982hghsaf@ec2-27-554-22-22.eu-east-1.compute.amazonaws.com:5219/sajdoiawohg3
> ```

**Local DB**

-   Create a new database and start postgres service
-   Enter your database details to your .env file
-   NOTE: Use pgsql-local instead of pgql as driver

> Sample
>
> ```env
> DB_CONNECTION=pgsql-local
> DB_HOST=127.0.0.1
> DB_PORT=5432
> DB_DATABASE=taskrepo
> DB_USERNAME=felix
> DB_PASSWORD=123
> ```

## Populating your database

Run migration & seed database

`php artisan migrate:fresh --seed`

## Running tests

Run all tests

`php artisan test`

## Made by:

-   [felixgren](https://github.com/felixgren)
-   [Martin Hansson](https://github.com/alegherix)
