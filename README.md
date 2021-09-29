### PESAKIT_


`` cp .env.example .env``


## Setup

```sh

php artisan migrate

php artisan passport:install

php artisan db:seed

```

## Running

```sh
php artisan serve

```

## Locally
```sh
Open another port and run:

sudo PHP_CLI_SERVER_WORKERS=10 php artisan serve --port=9090 --host 0.0.0.0

```