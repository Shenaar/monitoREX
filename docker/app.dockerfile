FROM php:7.2-fpm

# Install selected extensions and other stuff
RUN apt-get update && apt-get install -y libmcrypt-dev \
    mysql-client --no-install-recommends \
    && docker-php-ext-install pdo_mysql
