FROM php:7-fpm

LABEL maintainer="Martin Wind <martin.wind@im-c.de>"

WORKDIR /var/www

RUN apt-get update \
  && apt-get install -y libzip-dev unzip \
  && docker-php-ext-install zip \
  && curl https://raw.githubusercontent.com/composer/getcomposer.org/master/web/installer | php --

COPY . /var/www

RUN php composer.phar install
