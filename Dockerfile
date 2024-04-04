# Use PHP 8.2 with Apache as base image
FROM php:8.2-apache

# Update package lists and install required dependencies
RUN apt-get update \
    && apt-get install -y git libzip-dev zip unzip libpq-dev \
    && apt-get clean
# RUN apt-get install -y git libzip-dev zip unzip npm

# Install PHP extensions

RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql zip

# Enable Apache modules
RUN a2enmod rewrite \
    && a2enmod headers

# Install Composer globally

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -r app -g 1000 && useradd -u 1000 -r -g app -m -d /app -s /sbin/nologin -c "App user" app && \
    chmod 755 /var/www/html

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

# Set PHP configurations for file uploads

RUN echo "file_uploads = On\n" \
    "memory_limit = 500M\n" \
    "upload_max_filesize = 500M\n" \
    "post_max_size = 500M\n" \
    "max_execution_time = 600\n" \
    > /usr/local/etc/php/conf.d/uploads.ini

# Set Apache server name

RUN echo 'ServerName 127.0.0.1' >> /etc/apache2/apache2.conf

USER app

# COPY docker/entrypoint.sh /var/www/html/entrypoint.sh
# COPY docker/entrypoint.sh /var/www/html/docker/entrypoint.sh

# Set working directory
WORKDIR /var/www/html

USER root

# Copy application files to the container

COPY . .

# Install production dependencies
RUN composer install --optimize-autoloader --no-dev

# # Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - 
RUN apt-get install -y nodejs
RUN npm install

# Build frontend assets

RUN npm run build

# Adjust permissions for certain directories

RUN chmod o+w ./storage/ -R
RUN chmod o+w ./public/ -R
RUN chmod o+w ./bootstrap/ -R

# Copy Apache configuration files

COPY docker/web/default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/web/default.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/web/mpm_prefork.conf /etc/apache2/mods-available/mpm_prefork.conf 

# Copy the entrypoint script into the container
COPY docker/entrypoint.sh /usr/local/bin/

# Grant execution permissions to the entrypoint script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose port 80
EXPOSE 80

# Set the entrypoint to execute the entrypoint script
ENTRYPOINT ["entrypoint.sh"]

# # Start Apache in the foreground
CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]