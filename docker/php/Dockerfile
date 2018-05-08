FROM php:7.1-fpm

RUN apt-get update && apt-get install -y libssl-dev && rm -rf /var/lib/apt/lists/*

RUN pecl install mongodb \
    && docker-php-ext-enable mongodb

# Permission fix
RUN usermod -u 1000 www-data
