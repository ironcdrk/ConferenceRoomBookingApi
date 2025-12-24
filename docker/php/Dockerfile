# syntax=docker/dockerfile:1

FROM php:8.3-fpm-alpine AS base

WORKDIR /var/www

# Dependencias del sistema + extensiones comunes para Laravel/Postgres
RUN apk add --no-cache \
    bash git curl unzip icu-dev oniguruma-dev libzip-dev \
    postgresql-dev linux-headers $PHPIZE_DEPS \
 && docker-php-ext-install \
    intl mbstring zip pdo pdo_pgsql opcache

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# =========================
# DEV stage (Xdebug + ini)
# =========================
FROM base AS dev

RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

# Evita problemas de permisos en storage/bootstrap en Linux
RUN addgroup -g 1000 -S appgroup && adduser -u 1000 -S appuser -G appgroup
USER appuser

CMD ["php-fpm"]
