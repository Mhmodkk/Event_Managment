FROM php:8.2-cli

# ===============================
# 1. تثبيت الاعتماديات الأساسية
# ===============================
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

# ===============================
# 2. تثبيت امتدادات PHP الكاملة
# ===============================
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

# ===============================
# 3. تثبيت Imagick
# ===============================
RUN pecl install imagick \
    && docker-php-ext-enable imagick

# ===============================
# 4. نسخ Composer
# ===============================
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ===============================
# 5. إعداد مجلد العمل
# ===============================
WORKDIR /var/www/html

# ===============================
# 6. نسخ ملفات المشروع
# ===============================
COPY . .

# ===============================
# 7. تثبيت وتحميل الـ Assets (مع معالجة الأخطاء)
# ===============================
# تثبيت حزم Node
RUN npm ci

# تشغيل build مع حفظ المخرجات للتشخيص
RUN npm run build 2>&1 | tee /tmp/vite-build.log

# ✅ التحقق من نجاح الـ Build ووجود الملفات المطلوبة
RUN if [ ! -f "public/build/manifest.json" ]; then \
    echo "❌ ERROR: Vite build failed! manifest.json not found."; \
    echo "=== Vite Build Log ==="; \
    cat /tmp/vite-build.log; \
    exit 1; \
    fi

# ===============================
# 8. تثبيت حزم PHP
# ===============================
RUN composer install --no-dev --optimize-autoloader --ignore-platform-req=ext-gd

# ===============================
# 9. إعداد الملفات الثابتة (الصور)
# ===============================
RUN mkdir -p public/logos storage/app/public/logos
RUN cp resources/Image/HPU.png public/logos/HPU.png 2>/dev/null || true
RUN cp storage/app/public/logos/HPU.png public/logos/HPU.png 2>/dev/null || true

# ===============================
# 10. ربط مجلد التخزين
# ===============================
RUN php artisan storage:link --force

# ===============================
# 11. إعداد الصلاحيات (مهم جداً)
# ===============================
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache public

# ===============================
# 12. متغيرات البيئة للإنتاج
# ===============================
ENV APP_ENV=production \
    APP_DEBUG=true \
    LOG_CHANNEL=stderr \
    LOG_LEVEL=debug

# ===============================
# 13. الأمر النهائي للتشغيل
# ===============================
CMD ["sh", "-c", "php artisan migrate:fresh --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=${PORT}"]
