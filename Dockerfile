FROM php:8.2-cli

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /app

# Copy application files
COPY mini-crm /app

# Install PHP dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Generate application key and cache
RUN php artisan key:generate --force || true && \
    php artisan config:cache || true && \
    php artisan route:cache || true

# Expose port
EXPOSE 8000

# Start application
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
