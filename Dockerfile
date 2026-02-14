FROM php:8.2-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    curl \
    pkg-config \
    libonig-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    zlib1g-dev \
    nginx \
    && rm -rf /var/lib/apt/lists/*

# Configure and build GD with explicit paths to dependencies
RUN docker-php-ext-configure gd --with-jpeg=/usr/include --with-freetype=/usr/include/freetype2 && \
    docker-php-ext-install -j$(nproc) gd zip pdo_mysql mbstring tokenizer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-ansi --no-interaction --no-dev --optimize-autoloader --no-scripts

RUN chown -R www-data:www-data . && chmod -R 755 storage bootstrap/cache

COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80 9000

CMD ["sh", "-c", "php-fpm -D && nginx -g 'daemon off;'"]
