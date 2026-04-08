FROM php:8.2-fpm

LABEL maintainer="richard@example.com"

# ---------------------------------------------------------
# Install system dependencies
# ---------------------------------------------------------
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql pgsql zip \
    && rm -rf /var/lib/apt/lists/*

# ---------------------------------------------------------
# Install Composer (latest stable)
# ---------------------------------------------------------
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# ---------------------------------------------------------
# Set working directory
# ---------------------------------------------------------
WORKDIR /var/www/html

# ---------------------------------------------------------
# Copy custom PHP configuration (optional)
# ---------------------------------------------------------
# Create php.ini overrides folder
RUN mkdir -p /usr/local/etc/php/conf.d

# If you create php.ini, it will be copied here:
# COPY ./php.ini /usr/local/etc/php/conf.d/custom.ini

# ---------------------------------------------------------
# Permissions (optional but recommended)
# ---------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html
