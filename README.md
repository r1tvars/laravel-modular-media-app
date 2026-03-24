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

## Run With Docker

Copy .env.example and create .env in app-main

From the project root:

Run all variants:

```bash
docker compose --profile all up -d --build
```

Run one variant only:

```bash
docker compose --profile catalog up -d --build
docker compose --profile campaigns up -d --build
docker compose --profile full up -d --build
```

Stop containers:

```bash
docker compose down
```

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

These decide which modules are installed in the container.

## Notes

- Queue workers are started for the campaigns and full variants.
