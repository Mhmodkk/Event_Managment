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
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring bcmath zip

RUN pecl install imagick \
    && docker-php-ext-enable imagick

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN npm ci
RUN npm run build

RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd

RUN mkdir -p public/logos
RUN cp resources/Image/HPU.png public/logos/HPU.png 2>/dev/null || true
RUN cp storage/app/public/logos/HPU.png public/logos/HPU.png 2>/dev/null || true

RUN php artisan storage:link

CMD php artisan migrate:fresh --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT}
