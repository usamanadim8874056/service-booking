FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zlib1g-dev \
    nginx \
    supervisor \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install -j$(nproc) \
    gd \
    zip \
    pdo_mysql \
    mbstring \
    tokenizer \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-ansi --no-interaction --optimize-autoloader --no-scripts

# Set permissions
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 storage bootstrap/cache

# Configure Nginx
RUN mkdir -p /etc/nginx/sites-available && \
    echo 'server { \
        listen 80; \
        server_name _; \
        root /var/www/html/public; \
        index index.php; \
        location / { \
            try_files $uri $uri/ /index.php?$query_string; \
        } \
        location ~ \.php$ { \
            fastcgi_pass 127.0.0.1:9000; \
            fastcgi_index index.php; \
            include fastcgi_params; \
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
        } \
    }' > /etc/nginx/sites-available/default

# Configure supervisord
RUN mkdir -p /etc/supervisor/conf.d && \
    echo '[supervisord] \
nodaemon=true \
\
[program:php-fpm] \
command=/usr/local/sbin/php-fpm \
autostart=true \
autorestart=true \
\
[program:nginx] \
command=/usr/sbin/nginx -g "daemon off;" \
autostart=true \
autorestart=true' > /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
