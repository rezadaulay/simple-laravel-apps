# Article App
> Article management system
This project built with [Laravel 9](https://laravel.com/docs/9.x/).

## Requirements

- PHP >= 8.0
- Memcached or other cache drivers support [Cache Tags](https://laravel.com/docs/9.x/cache#cache-tags)


## Preparations

- Make sure your php dan mysql are running
- Setting `.env` file

## Setup

- `php artisan migrate`
- `php artisan db:seed`
- `php artisan storage:link`

## Run Project

- `php artisan serve`
- login with email "admin@admin.com" and password "password"