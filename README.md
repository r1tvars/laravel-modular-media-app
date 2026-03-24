# Laravel Modular Media App

Modules:

- `catalog-module`
- `campaigns-module`
- `support-module`

The application can run in three variants:

- Server 1: Catalog only
- Server 2: Campaigns only
- Server 3: Full application with both modules

## Project Structure

- `app-main/` - main Laravel application
- `packages/catalog-module/` - catalog module
- `packages/campaigns-module/` - campaigns module
- `packages/support-module/` - shared support code
- `docker/` - Docker files and Nginx configs
- `docker-compose.yml` - Docker services

## Requirements

- Docker
- Docker Compose

## Initial Setup

Copy the environment file:

~~~bash
cp app-main/.env.example app-main/.env
~~~

## Run With Docker

From the project root, start all variants:

~~~bash
docker compose --profile all up -d --build
~~~

Or run one variant only:

~~~bash
docker compose --profile catalog up -d --build
docker compose --profile campaigns up -d --build
docker compose --profile full up -d --build
~~~

## Laravel App Setup

Generate the application key for each variant:

~~~bash
docker compose exec app_catalog php artisan key:generate --force
docker compose exec app_campaigns php artisan key:generate --force
docker compose exec app_full php artisan key:generate --force
~~~

Install frontend dependencies, build assets, and run migrations for each variant.

### Catalog

~~~bash
docker compose exec app_catalog npm install
docker compose exec app_catalog npm run build
docker compose exec app_catalog php artisan migrate --force
docker compose exec app_catalog php artisan db:seed --force
~~~

### Campaigns

~~~bash
docker compose exec app_campaigns npm install
docker compose exec app_campaigns npm run build
docker compose exec app_campaigns php artisan migrate --force
docker compose exec app_campaigns php artisan db:seed --force
~~~

### Full

~~~bash
docker compose exec app_full npm install
docker compose exec app_full npm run build
docker compose exec app_full php artisan migrate --force
docker compose exec app_full php artisan db:seed --force
~~~

## Stop Containers

~~~bash
docker compose down
~~~

## Ports

- Catalog: `http://localhost:8081`
- Campaigns: `http://localhost:8082`
- Full: `http://localhost:8083`
- MySQL: `localhost:33060`

## Composer Variants

The Docker build uses different Composer files for each server variant:

- `app-main/composer.catalog.json`
- `app-main/composer.campaigns.json`
- `app-main/composer.full.json`

These decide which module packages are loaded for each app variant.

## Notes

- Queue workers are started for the campaigns and full variants.
- The same `app-main/.env` file is used by all three variants.
