#!/usr/bin/env bash

docker-compose build
docker-compose run -u default app composer install
docker-compose run -u default app php artisan key:generate
docker-compose up -d
docker-compose exec -u default app php artisan migrate:fresh
