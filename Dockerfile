FROM php:8.4-cli

WORKDIR /app

ARG CACHE_BUST=2

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    libzip-dev \
    libicu-dev \
    && docker-php-ext-install pdo pdo_mysql zip intl opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan migrate:fresh --force && php artisan serve --host=0.0.0.0 --port=$PORT
