ARG PHP_VERSION=8.3
FROM php:${PHP_VERSION}-fpm-alpine AS base

WORKDIR /var/www

# ---- System deps (runtime) + build deps (para compilar extensiones) ----
# Nota: $PHPIZE_DEPS ya incluye herramientas de compilación (autoconf, make, gcc, etc.)
RUN apk add --no-cache \
      bash git curl unzip icu-dev oniguruma-dev libzip-dev \
      postgresql-dev linux-headers \
      $PHPIZE_DEPS \
 && docker-php-ext-install \
      intl mbstring zip pdo pdo_pgsql opcache \
 && rm -rf /tmp/*

# Composer 
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---- Usuario con UID/GID parametrizable ----
ARG UID=1000
ARG GID=1000

RUN addgroup -g ${GID} -S appgroup \
 && adduser -u ${UID} -S appuser -G appgroup

# Usuario para VS Code / Dev Containers
RUN adduser -D -s /bin/sh vscode

# =========================
# DEV stage
# =========================
FROM base AS dev

# Xdebug (dev)
RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

COPY docker/php/php.ini /usr/local/etc/php/conf.d/99-custom.ini
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d/99-xdebug.ini

RUN mkdir -p storage bootstrap/cache \
 && chown -R appuser:appgroup /var/www

USER appuser

CMD ["php-fpm"]
