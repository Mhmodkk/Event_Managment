FROM php:8.2-cli

# system deps
RUN apt-get update && apt-get install -y \
    git curl unzip zip \
    libpng-dev libonig-dev libxml2-dev libzip-dev libsodium-dev \
    libjpeg-dev libfreetype6-dev \
    default-mysql-client default-libmysqlclient-dev \
    libmagickwand-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# php extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring bcmath zip gd

# imagick
RUN pecl install imagick && docker-php-ext-enable imagick

# composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

# composer install (optimized)
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

# npm install
COPY package.json package-lock.json ./
RUN npm install

# copy project
COPY . .

# build assets
RUN npm run build

# permissions
RUN mkdir -p storage/framework/{sessions,views,cache} public/logos \
    && chown -R www-data:www-data storage bootstrap/cache public \
    && chmod -R 775 storage bootstrap/cache

# run
CMD ["sh", "-c", "php artisan storage:link --force && php artisan config:clear && php artisan view:clear && php artisan route:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
