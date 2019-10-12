# 创建一个包含常用扩展的php镜像
FROM php:7.3-fpm
MAINTAINER xqhero 
# 更新apt-get源
RUN  sed -i "s@http://deb.debian.org@http://mirrors.aliyun.com@g" /etc/apt/sources.list
RUN  apt-get clean && apt-get update

RUN apt-get install apt-utils -y
# 安装GD扩展
RUN apt-get install -y libfreetype6-dev libjpeg-dev libpng-dev libwebp-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-png-dir=/usr/include/ --with-webp-dir=/usr/include/
RUN docker-php-ext-install gd

# 安装Intl
RUN apt-get install -y libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

# 安装常规的
RUN apt-get install -y libzip-dev
RUN docker-php-ext-install pdo_mysql zip pcntl opcache sockets

# pecl 安装
#　安装redis扩展
RUN pecl install redis && docker-php-ext-enable redis
# 安装swoole扩展
RUN pecl install swoole && docker-php-ext-enable swoole

# 源码安装
# 安装phalcon扩展
COPY cphalcon7.tar.gz /tmp
RUN mkdir -p /tmp/phalcon \
    && tar -xf /tmp/cphalcon7.tar.gz -C /tmp/phalcon \
    && rm /tmp/cphalcon7.tar.gz \
    && cd /tmp/phalcon/cphalcon7/ext \
    && ls -l \
    && phpize \
    && ./configure --enable-phalcon \
    && make \
    && make install \
    && docker-php-ext-enable phalcon \
    && rm -r /tmp/phalcon

# 安装memcache扩展
COPY memcache.tar.gz /tmp
RUN apt-get install -y zlib1g-dev libmemcached-dev
RUN tar -xf /tmp/memcache.tar.gz -C /tmp \
    && rm -rf /tmp/memcache.tar.gz \
    && docker-php-ext-configure /tmp/pecl-memcache --enable-memcache \
    && docker-php-ext-install /tmp/pecl-memcache \
    && rm -r /tmp/pecl-memcache

# 安装git 和 composer
RUN apt-get -y install git
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/bin/ --filename=composer 

