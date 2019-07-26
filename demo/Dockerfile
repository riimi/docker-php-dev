FROM php:7.2-fpm-alpine

RUN apk --update --no-cache add autoconf g++ make yaml-dev zlib-dev libmemcached-dev

# php 개발환경에 필요한 라이브러리들 설치
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN docker-php-ext-install pdo
RUN docker-php-ext-install pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install yaml && docker-php-ext-enable yaml
RUN pecl install memcached && docker-php-ext-enable memcached

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

COPY ./app /var/www/html
WORKDIR /var/www/html
RUN composer install

EXPOSE 9000
CMD ["php-fpm"]

