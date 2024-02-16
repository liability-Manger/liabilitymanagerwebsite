# Use the official phpMyAdmin image as a base
FROM phpmyadmin/phpmyadmin:latest

# Set environment variables for MySQL connection
ENV PMA_HOST=mysql
ENV PMA_USER=admin
ENV PMA_PASSWORD=admin
ENV PMA_ARBITRARY=1

# If you need to install additional tools or PHP extensions, you can do so here
# For example, to install vim and a PHP extension:
# RUN apt-get update && apt-get install -y vim \
#     && docker-php-ext-install mysqli

# Copy a custom configuration file if needed
# COPY config.user.inc.php /etc/phpmyadmin/config.user.inc.php

# Expose port 80 to access phpMyAdmin
EXPOSE 80

# The official phpMyAdmin image uses an entrypoint script that automatically starts Apache
# If you need to execute additional commands, you can override the entrypoint or cmd directives
# ENTRYPOINT [""]
# CMD ["apache2-foreground"]
