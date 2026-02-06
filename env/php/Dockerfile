FROM php:8.4-fpm-alpine

RUN apk add --no-cache \
    bash \
    curl \
    git \
    libzip-dev \
    zip \
    unzip \
    nodejs \
    npm \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    postgresql-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    zip \
    gd \
    intl \
    mbstring \
    exif \
    pcntl

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel
WORKDIR /var/www

RUN chown -R laravel:laravel /var/www
USER laravel
EXPOSE 9000
CMD ["php-fpm"]