# Use an official phpMyAdmin image as base
FROM phpmyadmin/phpmyadmin:latest

# Set environment variables for MySQL connection
ENV PMA_HOST=mysql
ENV PMA_USER=admin
ENV PMA_PASSWORD=admin

# The port phpMyAdmin will run on
EXPOSE 80

# Start phpMyAdmin
CMD ["apache2-foreground"]
