FROM node:20 AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm install --ignore-scripts

COPY . .
RUN npm run build

FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git \
    curl \
    unzip \
    zip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libsodium-dev \
    default-mysql-client \
    default-libmysqlclient-dev \
    libmagickwand-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring bcmath zip

RUN pecl install imagick \
    && docker-php-ext-enable imagick

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

COPY --from=frontend /app/public/build ./public/build

RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd

CMD php artisan migrate:fresh --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT}
