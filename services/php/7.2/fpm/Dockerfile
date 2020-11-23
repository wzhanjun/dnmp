FROM php:7.2-fpm-stretch

ENV PHPREDIS_VERSION 5.1.1

RUN sed -i "s@http://deb.debian.org@http://mirrors.aliyun.com@g" /etc/apt/sources.list \
    && sed -i "s@security.debian.org@mirrors.aliyun.com@g" /etc/apt/sources.list \
    && rm -Rf /var/lib/apt/lists/* && apt-get clean && apt-get update --fix-missing

RUN apt-get install -y \
    libpng-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev libxpm-dev \
    libfreetype6-dev \
    ffmpeg \
    libssl-dev \
    supervisor --fix-missing

RUN docker-php-ext-configure gd \
    --with-gd \
    --with-webp-dir \
    --with-jpeg-dir \
    --with-png-dir \
    --with-zlib-dir \
    --with-xpm-dir \
    --with-freetype-dir

RUN docker-php-ext-install pdo_mysql mysqli  gd sockets \
    && curl -L -o /tmp/redis.tar.gz https://github.com/phpredis/phpredis/archive/$PHPREDIS_VERSION.tar.gz \
    && tar zxvf /tmp/redis.tar.gz \
    && rm -r /tmp/redis.tar.gz \
    && mkdir -p /usr/src/php/ext \
    && mv phpredis-$PHPREDIS_VERSION /usr/src/php/ext/redis \
    && docker-php-ext-install redis \
    && rm -rf /usr/src/php

RUN pecl install mongodb \
&&  echo "extension=mongodb.so" > /usr/local/etc/php/conf.d/mongodb.ini

RUN pecl install swoole \
&&  echo "extension=swoole.so" > /usr/local/etc/php/conf.d/swoole.ini

RUN curl -L -o /tmp/libkafka-v1.5.2.tar.gz https://github.com/edenhill/librdkafka/archive/v1.5.2.tar.gz \
    && cd /tmp && tar zxvf /tmp/libkafka-v1.5.2.tar.gz \
    && cd librdkafka-1.5.2 && ./configure && make && make install \
    && rm -r /tmp/libkafka-v1.5.2.tar.gz \
    && pecl install rdkafka \
    && echo "extension=rdkafka.so" > /usr/local/etc/php/conf.d/rdkafka.ini

WORKDIR /data/www
EXPOSE 9000
EXPOSE 8181
# CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/supervisord.conf"]
