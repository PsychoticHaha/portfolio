FROM php:8.2-apache

# Install required PHP extensions and enable Apache modules
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Configure Apache virtual host
COPY vhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
