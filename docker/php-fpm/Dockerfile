FROM php:7.3-fpm
MAINTAINER xqhero 
# 安装pdo_mysql扩展
#RUN docker-php-ext-install pdo_mysql
# 安装redis扩展
#RUN pecl install redis && docker-php-ext-enable redis
# 安装swoole扩展
#RUN pecl install swoole && docker-php-ext-enable swoole
# 安装phalcon扩展
#COPY cphalcon7.tar.gz /tmp
#RUN mkdir -p /tmp/phalcon \
#    && tar -xf /tmp/cphalcon7.tar.gz -C /tmp/phalcon \
#    && rm /tmp/cphalcon7.tar.gz \
#    && cd /tmp/phalcon/cphalcon7/ext \
#    && ls -l \
#    && phpize \
#    && ./configure --enable-phalcon \
#    && make \
#    && make install \
#    && docker-php-ext-enable phalcon
#    && rm -r /tmp/phalcon

# 安装memcache扩展
#COPY memcache.tar.gz /tmp
#COPY ./source.list /etc/apt/sources.list
RUN  sed -i "s@http://deb.debian.org@http://mirrors.aliyun.com@g" /etc/apt/sources.list
RUN  apt-get clean
RUN  apt-get update
#RUN apt-get install -y zlib1g-dev libmemcached-dev
#RUN tar -xf /tmp/memcache.tar.gz -C /tmp \
#    && rm -rf /tmp/memcache.tar.gz \
#    && docker-php-ext-configure /tmp/pecl-memcache --enable-memcache \
#    && docker-php-ext-install /tmp/pecl-memcache \
#    && rm -r /tmp/pecl-memcache

# 安装git
RUN apt-get -y install git
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/bin/ --filename=composer 


#WORKDIR /www

