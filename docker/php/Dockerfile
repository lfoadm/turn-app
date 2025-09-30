FROM php:8.3-fpm

# Instalar extensões PHP necessárias
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpq-dev libicu-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo_mysql intl mbstring zip

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
