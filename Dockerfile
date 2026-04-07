# Stage 1 : Build des dépendances
FROM composer:2.6 as build

WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction

COPY . .

# Stage 2 : Image de production
FROM php:8.2-fpm-alpine

# Extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_mysql

# Copier les fichiers depuis le stage build
COPY --from=build /app /var/www/html

WORKDIR /var/www/html

# Sécurité : utilisateur non-root
RUN addgroup -g 1000 laravel && adduser -G laravel -u 1000 -s /bin/sh -D laravel
RUN chown -R laravel:laravel /var/www/html
USER laravel

EXPOSE 9000

CMD ["php-fpm"]