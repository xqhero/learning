FROM php:7.3-fpm
RUN pecl install redis && docker-php-ext-enable redis
RUN docker-php-ext-install pdo pdo_mysql && docker-php-ext-enable pdo_mysql
