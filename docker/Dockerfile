FROM php:8.0-apache

WORKDIR /var/www/html

# Update package lists and install necessary dependencies
RUN apt-get update \
    && apt-get install -y \
        libpng-dev \
        libzip-dev \
        unzip \
        git \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install \
    mysqli \
    pdo \
    pdo_mysql \
    gd \
    zip

# Enable installed PHP extensions
RUN docker-php-ext-enable \
    pdo_mysql \
    gd \
    zip

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer
