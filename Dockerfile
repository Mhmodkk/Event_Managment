# 1. استخدام نسخة CLI كما كنت تفضل، لكن مع تحسينات الاستقرار
FROM php:8.2-cli

# 2. تثبيت التبعيات الضرورية للنظام
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

# 3. تثبيت إضافات PHP
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

# 4. تثبيت Imagick
RUN pecl install imagick \
    && docker-php-ext-enable imagick

# 5. جلب Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 6. إعداد مجلد العمل
WORKDIR /var/www/html

# 7. نسخ ملفات المشروع
COPY . .

# 8. تثبيت مكتبات PHP (Composer)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd

# 9. تثبيت مكتبات Node وبناء ملفات Vite/Mix
RUN npm ci && npm run build

# 10. إعداد المجلدات والصلاحيات (هذا الجزء يمنع الصفحة البيضاء)
RUN mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache public/logos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache /var/www/html/public
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# 11. ربط التخزين
RUN php artisan storage:link --force

# 12. إعدادات البيئة للإنتاج
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr

# 13. أمر التشغيل النهائي
# ملاحظة: تم استبدال migrate:fresh بـ migrate العادية للحفاظ على البيانات وسرعة التشغيل
CMD ["sh", "-c", "php artisan config:cache && php artisan route:cache && php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}"]
