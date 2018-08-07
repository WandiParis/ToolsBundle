FROM php:7.1-apache

RUN apt-get update && apt-get install -y wget git zip unzip nodejs npm \
    && ln -s /usr/bin/nodejs /usr/bin/node

RUN apt-get install -y zlib1g-dev libicu-dev g++ curl libcurl3 nano

COPY php.ini /usr/local/etc/php/conf.d/

RUN a2enmod rewrite

# composer
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# php-cs-fixer
RUN curl -L http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -o php-cs-fixer \
    && chmod a+x php-cs-fixer \
    && mv php-cs-fixer /usr/local/bin/php-cs-fixer

WORKDIR /var/www/html
