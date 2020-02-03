FROM php:7.3

WORKDIR /code

RUN apt-get update && apt-get install -y wget git libxml2 libxml2-dev
RUN wget https://get.symfony.com/cli/installer -O - | bash
RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd
    
RUN apt-get install -y mysql-client

RUN docker-php-ext-configure iconv
RUN docker-php-ext-install iconv
RUN docker-php-ext-install soap
RUN docker-php-ext-configure pdo
RUN docker-php-ext-install pdo
RUN docker-php-ext-configure pdo_mysql
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-configure sockets
RUN docker-php-ext-install sockets
RUN apt-get -y install libmemcached-dev memcached
RUN pecl install memcache
RUN echo "extension=memcache.so" >> /usr/local/etc/php/conf.d/memcache.ini

RUN echo "date.timezone=Europe/Paris" >> "/usr/local/etc/php/conf.d/date.ini"

CMD ["/usr/local/bin/symfony", "serve"] 