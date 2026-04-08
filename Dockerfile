# Stage 1 : Build des dépendances
FROM composer:2.6 as build

WORKDIR /app
COPY composer.json composer.lock ./
# On utilise --ignore-platform-reqs pour s'assurer que le build passe même si une extension manque dans l'image build
RUN composer install --no-dev --optimize-autoloader --no-interaction --ignore-platform-reqs

COPY . .

# Stage 2 : Image de production
FROM php:8.2-fpm-alpine

# Installation des dépendances système nécessaires pour les extensions PHP
RUN apk add --no-cache \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    curl-dev

# Installation des extensions PHP requises pour Laravel 12
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd xml

# Copier les fichiers depuis le stage build
COPY --from=build /app /var/www/html

WORKDIR /var/www/html

# Sécurité : utilisateur non-root (exigence du projet)
RUN addgroup -g 1000 laravel && adduser -G laravel -u 1000 -s /bin/sh -D laravel
RUN chown -R laravel:laravel /var/www/html
USER laravel

EXPOSE 9000

CMD ["php-fpm"]