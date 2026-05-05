FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl unzip zip libpng-dev libonig-dev libxml2-dev libzip-dev libsodium-dev \
    default-mysql-client default-libmysqlclient-dev libmagickwand-dev \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo_mysql mbstring bcmath zip fileinfo tokenizer ctype xml session
RUN pecl install imagick && docker-php-ext-enable imagick

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd
RUN npm ci && npm run build

RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache public/logos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

RUN php artisan storage:link --force

ENV APP_ENV=production APP_DEBUG=false LOG_CHANNEL=stderr

# النسخة المتوافقة مع معايير Docker (JSON Args)
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan migrate --force && exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
