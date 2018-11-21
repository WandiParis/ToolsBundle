FROM php:7.1-cli

RUN apt-get update && apt-get install -y mysql-client curl git \
    libfreetype6-dev libjpeg62-turbo-dev libmcrypt-dev \
    && docker-php-ext-install iconv mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install opcache \
    && docker-php-ext-install mbstring

# composer
ENV COMPOSER_ALLOW_SUPERUSER 1
RUN curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer \
    && chmod +x /usr/bin/composer
RUN composer self-update
RUN composer global require "hirak/prestissimo:^0.3" --prefer-dist --no-progress --no-suggest --optimize-autoloader --classmap-authoritative  --no-interaction
ENV PATH /root/.composer/vendor/bin:$PATH

# php-cs-fixer
RUN curl -L http://cs.sensiolabs.org/download/php-cs-fixer-v2.phar -o /usr/bin/php-cs-fixer \
    && chmod +x /usr/bin/php-cs-fixer
RUN php-cs-fixer self-update

# phpunit
RUN composer global require "phpunit/phpunit"
RUN ln -s /root/.composer/vendor/bin/phpunit /usr/bin/phpunit