# Use the official PHP with Apache image
FROM php:apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    && docker-php-ext-install mysqli pdo_mysql zip

# Set recommended PHP.ini settings for development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

# Set timezone
RUN echo "date.timezone = UTC" >> "$PHP_INI_DIR/php.ini"

# Set up phpMyAdmin
ENV PHPMYADMIN_VERSION=5.1.1
RUN mkdir -p /var/www/html/phpmyadmin \
    && curl -L https://github.com/phpmyadmin/phpmyadmin/archive/refs/tags/rel-${PHPMYADMIN_VERSION}.tar.gz | tar xz --strip-components=1 -C /var/www/html/phpmyadmin \
    && mv /var/www/html/phpmyadmin/config.sample.inc.php /var/www/html/phpmyadmin/config.inc.php

# Expose ports
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]

