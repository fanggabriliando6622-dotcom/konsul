FROM dunglas/frankenphp:php8.4

# Install PHP extensions
RUN install-php-extensions \
    intl \
    zip \
    pdo_mysql \
    mbstring \
    curl \
    dom \
    fileinfo \
    openssl

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=$PORT