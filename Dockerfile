FROM dunglas/frankenphp:php8.2

RUN install-php-extensions \
    intl \
    zip \
    pdo_mysql \
    mbstring \
    curl \
    dom \
    fileinfo \
    openssl

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

CMD php artisan serve --host=0.0.0.0 --port=$PORT