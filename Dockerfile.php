# Use the official PHP with Apache image
FROM php:apache

# Set working directory
WORKDIR /var/www/html

# Update package manager and install dependencies
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    && docker-php-ext-install mysqli pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Set recommended PHP.ini settings for development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Set timezone
RUN echo "date.timezone = UTC" >> "$PHP_INI_DIR/php.ini"

# Set up phpMyAdmin
ENV PHPMYADMIN_VERSION=5.1.1
RUN mkdir -p /var/www/html/phpmyadmin \
    && curl -L https://github.com/phpmyadmin/phpmyadmin/archive/rel-${PHPMYADMIN_VERSION}.tar.gz | tar xz --strip-components=1 -C /var/www/html/phpmyadmin \
    && mv /var/www/html/phpmyadmin/config.sample.inc.php /var/www/html/phpmyadmin/config.inc.php

# Expose ports
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
