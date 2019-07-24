FROM php:7.2-fpm-alpine

RUN apk --update --no-cache add autoconf g++ make

RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis

WORKDIR /var/www/html

EXPOSE 9000
CMD ["php-fpm"]

