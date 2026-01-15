# -------------------------------
# Use PHP 8.4 FPM
# -------------------------------
FROM php:8.4-fpm

# -------------------------------
# Install system dependencies
# -------------------------------
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql zip

# -------------------------------
# Install Composer
# -------------------------------
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# -------------------------------
# Set working directory
# -------------------------------
WORKDIR /var/www

# -------------------------------
# Copy project files
# -------------------------------
COPY . .

# -------------------------------
# Install PHP dependencies
# -------------------------------
RUN composer install --no-dev --optimize-autoloader

# -------------------------------
# Clear Laravel caches & generate key
# -------------------------------
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear \
    && php artisan key:generate

# -------------------------------
# Set permissions (optional)
# -------------------------------
RUN chown -R www-data:www-data /var/www \
    && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

# -------------------------------
# Expose port for Render
# -------------------------------
EXPOSE 8000

# -------------------------------
# Run Laravel server in production
# -------------------------------
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
