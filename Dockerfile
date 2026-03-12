FROM dunglas/frankenphp:php8.4

RUN install-php-extensions \
    intl \
    zip \
    pdo_mysql \
    mbstring \
    curl \
    dom \
    fileinfo \
    openssl \
    tokenizer \
    xml

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

CMD php artisan serve --host=0.0.0.0 --port=$PORT