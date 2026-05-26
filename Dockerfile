FROM dunglas/frankenphp:php8.2


RUN install-php-extensions \
    pdo_mysql \
    gd \
    mbstring \
    zip \
    exif \
    bcmath

WORKDIR /app

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN npm install
RUN npm run build

RUN chmod -R 777 storage bootstrap/cache

EXPOSE 8080

CMD php artisan optimize:clear && php artisan serve --host=0.0.0.0 --port=8080