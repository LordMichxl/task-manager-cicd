# Stage 1
FROM composer:2.9 AS build

WORKDIR /app
COPY . .

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --no-scripts \
    --ignore-platform-reqs

# Stage 2
FROM php:8.2-fpm-alpine

RUN apk add --no-cache \
    bash \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mbstring \
    xml \
    bcmath

WORKDIR /var/www

COPY --from=build /app /var/www

# Setup Laravel
RUN cp .env.example .env || true
RUN php artisan key:generate || true

RUN chown -R www-data:www-data /var/www

EXPOSE 9000

CMD ["php-fpm"]