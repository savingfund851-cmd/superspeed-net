FROM php:8.3-cli-alpine

# Install system dependencies
RUN apk add --no-cache \
    bash \
    curl \
    git \
    icu-dev \
    libpng-dev \
    libzip-dev \
    nodejs \
    npm \
    oniguruma-dev \
    libxml2-dev \
    zip \
    unzip \
    shadow

# Install PHP extensions (only non-built-in ones)
# Note: ctype, fileinfo, tokenizer are already built-in to php:8.3-cli-alpine
RUN docker-php-ext-install \
    bcmath \
    gd \
    intl \
    mbstring \
    pdo \
    pdo_mysql \
    xml \
    zip \
    opcache

# Enable sodium
RUN docker-php-ext-enable sodium 2>/dev/null || true

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Install Node dependencies and build assets
RUN npm ci && npm run build

# Run post-install composer scripts
RUN composer run-script post-autoload-dump || true

# Set permissions
RUN chmod -R 775 storage bootstrap/cache

# Expose port
EXPOSE 8000

# Start command: migrate, seed, serve
CMD php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    php artisan migrate --force && \
    php artisan db:seed --force && \
    php artisan storage:link && \
    php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
