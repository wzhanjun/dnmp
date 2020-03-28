FROM php:7.2-fpm-stretch

ENV PHPREDIS_VERSION 5.1.1

RUN apt-get update && apt-get install -y libpng-dev
RUN apt-get install -y \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev

RUN docker-php-ext-configure gd \
    --with-gd \
    --with-webp-dir \
    --with-jpeg-dir \
    --with-png-dir \
    --with-zlib-dir \
    --with-xpm-dir \
    --with-freetype-dir

RUN docker-php-ext-install gd

RUN docker-php-ext-install pdo_mysql mysqli \
    && curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz \
    && tar zxvf /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mkdir -p /usr/src/php/ext \
    && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
    && docker-php-ext-install redis \
    && rm -rf /usr/src/php

RUN apt-get install -y libssl-dev

RUN pecl install mongodb \
&&  echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

RUN pecl install swoole \
&&  echo "extension=swoole.so" > /usr/local/etc/php/conf.d/swoole.ini

WORKDIR /data/www
EXPOSE 9000