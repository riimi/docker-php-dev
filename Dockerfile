FROM php:7.2-fpm-alpine

RUN apk update

#RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN pecl install redis && docker php-ext-enable redis

COPY . /var/www/html
WORKDIR /var/www/html

#RUN composer.phar install  && composer.phar update

EXPOSE 9000
CMD ["php-fpm"]

