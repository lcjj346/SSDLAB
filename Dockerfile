# Use the official PHP image with Apache
FROM php:8.0-apache

# Copy application files
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html


# Expose port 80
EXPOSE 80
