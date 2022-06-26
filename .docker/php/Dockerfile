FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql

# Xdebug Install
RUN pecl install xdebug
COPY conf.d/xdebug.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Local Env for PHP-FPM
RUN echo clear_env = no >> /usr/local/etc/php-fpm.d/www.conf

