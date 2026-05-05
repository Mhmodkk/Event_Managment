FROM php:8.2-cli

# 1. تثبيت متطلبات النظام
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
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# 2. تثبيت إضافات PHP الأساسية فقط (البقية مدمجة تلقائياً في 8.2)
RUN docker-php-ext-install pdo_mysql mbstring bcmath zip

# 3. تثبيت Imagick
RUN pecl install imagick && docker-php-ext-enable imagick

# 4. إعداد المجلد وجلب Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html

# 5. نسخ ملفات المشروع
COPY . .

# 6. تثبيت المكتبات وبناء ملفات الـ Assets (Vite)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd
RUN npm ci && npm run build

# 7. إعداد المجلدات والصلاحيات (هذا الجزء هو من يمنع الصفحة البيضاء)
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache public/logos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 8. نسخ الصور التي طلبتها
RUN cp resources/Image/HPU.png public/logos/HPU.png 2>/dev/null || true
RUN cp storage/app/public/logos/HPU.png public/logos/HPU.png 2>/dev/null || true

# 9. إنشاء رابط التخزين
RUN php artisan storage:link --force

# 10. أوامر التشغيل النهائية
CMD ["sh", "-c", "rm -f bootstrap/cache/*.php && php artisan config:clear && php artisan view:clear && php artisan route:clear && php artisan migrate --force && exec php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
