FROM composer:2.7 as vendor
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM node:20 as frontend

RUN mkdir -p "/app/public"

COPY package*.json vite.config.js tailwind*.config.js /app/
COPY resources/ /app/resources/

WORKDIR /app

RUN npm ci

FROM php:8.3-alpine3.19

ENV PHP_OPCACHE_VALIDATE_TIMESTAMPS="0" \
    PHP_OPCACHE_MAX_ACCELERATED_FILES="10000" \
    PHP_OPCACHE_MEMORY_CONSUMPTION="192" \
    PHP_OPCACHE_MAX_WASTED_PERCENTAGE="10"

RUN apk update --no-cache && apk add --no-cache nginx \
    curl \
    git \
    supervisor \
    $PHPIZE_DEPS \
	openssl-dev

RUN apk add --no-cache \
      freetype \
      libjpeg-turbo \
      libpng \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && docker-php-ext-configure gd \
      --with-freetype=/usr/include/ \
      # --with-png=/usr/include/ \ # No longer necessary as of 7.4; https://github.com/docker-library/php/pull/910#issuecomment-559383597
      --with-jpeg=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-enable gd \
    && apk del --no-cache \
      freetype-dev \
      libjpeg-turbo-dev \
      libpng-dev \
    && rm -rf /tmp/*

RUN docker-php-ext-install opcache

RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

COPY docker /docker/

WORKDIR /var/www

RUN cp /docker/php.ini /usr/local/etc/php/conf.d/custom.ini && \
    cp /docker/opcache.ini /usr/local/etc/php/conf.d/opcache.ini && \
    cp /docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /etc/supervisor/conf.d && \
cp /docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

COPY --chown=www-data:www-data . /var/www
COPY --from=vendor /app/vendor/ /var/www/vendor/
COPY --from=frontend /app/public/ /var/www/public

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
