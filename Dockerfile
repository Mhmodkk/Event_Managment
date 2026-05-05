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


RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    bcmath \
    zip \
    fileinfo \
    tokenizer \
    ctype \
    xml \
    session


RUN pecl install imagick \
    && docker-php-ext-enable imagick


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


WORKDIR /var/www/html


COPY . .


RUN npm ci

RUN npm run build 2>&1 | tee /tmp/vite-build.log

RUN if [ ! -f "public/build/manifest.json" ]; then \
    echo "❌ ERROR: Vite build failed! manifest.json not found."; \
    echo "=== Vite Build Log ==="; \
    cat /tmp/vite-build.log; \
    exit 1; \
    fi


RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd

RUN mkdir -p public/logos storage/app/public/logos
RUN cp resources/Image/HPU.png public/logos/HPU.png 2>/dev/null || true
RUN cp storage/app/public/logos/HPU.png public/logos/HPU.png 2>/dev/null || true


RUN php artisan storage:link --force


RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache public


ENV APP_ENV=production \
    APP_DEBUG=true \
    LOG_CHANNEL=stderr \
    LOG_LEVEL=debug \
    SESSION_DRIVER=database \
    SESSION_LIFETIME=120 \
    TRUSTED_PROXIES=*

CMD ["/bin/sh", "-c", "php artisan migrate --force && php artisan db:seed --force && php artisan config:clear && php artisan serve --host=0.0.0.0 --port=$PORT"]
