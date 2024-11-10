FROM php:8.3-fpm
WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

COPY . .

RUN chown -R www-data:www-data /var/www/storage
CMD php artisan serve --host=0.0.0.0 --port=8000
EXPOSE 8000
