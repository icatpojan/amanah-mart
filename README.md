# Deployment
## Requirements
1. [**Laravel 7 server requirements**](https://laravel.com/docs/7.x#server-requirements)
## Complete Environment

1. Copy file `.env.example` to `.env`

```bash
cp .env.example .env
```

2. Fill form environment on file `.env` on `root` directory

## Composer Install

Run on `root` directory

```bash
composer install
```

## Running Migration and Seeder

```bash
php artisan migrate --seed
```
