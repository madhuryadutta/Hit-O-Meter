FROM php:8.2-apache
RUN apt-get update
RUN apt-get install -y git libzip-dev zip unzip
# RUN apt-get install -y git libzip-dev zip unzip npm
RUN docker-php-ext-install pdo pdo_mysql zip
RUN a2enmod rewrite
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer



RUN groupadd -r app -g 1000 && useradd -u 1000 -r -g app -m -d /app -s /sbin/nologin -c "App user" app && \
    chmod 755 /var/www/html

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

#upload
RUN echo "file_uploads = On\n" \
    "memory_limit = 500M\n" \
    "upload_max_filesize = 500M\n" \
    "post_max_size = 500M\n" \
    "max_execution_time = 600\n" \
    > /usr/local/etc/php/conf.d/uploads.ini
RUN echo 'ServerName 127.0.0.1' >> /etc/apache2/apache2.conf
USER app

WORKDIR /var/www/html

USER root

# COPY default.conf /etc/apache2/sites-enabled/000-default.conf
COPY docker/web/default.conf /etc/apache2/sites-available/000-default.conf
COPY docker/web/mpm_prefork.conf /etc/apache2/mods-available/mpm_prefork.conf 

# CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
EXPOSE 80
ENTRYPOINT [ "docker/entrypoint.sh" ]