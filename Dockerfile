# Use the official Nginx image from Docker Hub
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

# Expose port 80
EXPOSE 80

# Start Apache
CMD ["apache2-foreground"]
