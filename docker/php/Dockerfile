FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    nginx \
    unzip \
    zip \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libicu-dev \
    libsqlite3-dev \
    default-mysql-client \
    nodejs \
    npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite mbstring exif pcntl bcmath gd zip intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

ARG COMPOSER_VARIANT=composer.full.json

COPY ./app-main /var/www/html
COPY ./packages /var/www/packages
COPY ./docker/php/start.sh /usr/local/bin/start-app
COPY ./docker/nginx /etc/nginx/templates

RUN cp /var/www/html/${COMPOSER_VARIANT} /var/www/html/composer.json \
    && rm -f /var/www/html/composer.lock \
    && composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader \
    && mkdir -p /var/www/html/storage/framework/views \
        /var/www/html/storage/framework/cache \
        /var/www/html/storage/framework/sessions \
        /var/www/html/storage/logs \
        /run/php \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /run/php \
    && chmod +x /usr/local/bin/start-app \
    && php artisan package:discover --ansi || true

EXPOSE 80

CMD ["/usr/local/bin/start-app"]
