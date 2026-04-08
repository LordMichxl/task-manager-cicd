# Étape 1 : build des dépendances
FROM composer:2.6 as build

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

# Étape 2 : image finale
FROM php:8.2-fpm-alpine

WORKDIR /var/www/html

COPY --from=build /app .

# Installer extensions nécessaires Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Sécurité : utilisateur non-root
RUN addgroup -g 1000 laravel && adduser -u 1000 -G laravel -s /bin/sh -D laravel

USER laravel

EXPOSE 9000

CMD ["php-fpm"]