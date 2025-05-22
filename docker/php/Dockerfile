# Stage 1: Node for Vite asset building
FROM node:18 as nodebuilder

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY resources/ ./resources/
COPY vite.config.js tailwind.config.js postcss.config.js ./
RUN npm run build


# Stage 2: PHP & Composer
FROM php:8.2-fpm as app

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Copy Laravel project
WORKDIR /var/www

COPY . .

# Copy built assets from Node stage
COPY --from=nodebuilder /app/public/build ./public/build
COPY --from=nodebuilder /app/.vite/ ./.vite/

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader \
    && php artisan config:cache \
    && php artisan route:cache \
    && php artisan view:cache \
    && chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

EXPOSE 9000
CMD ["php-fpm"]
