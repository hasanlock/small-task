FROM php:7.3-cli-stretch

RUN useradd --create-home -s /bin/bash default

RUN apt-get update --fix-missing -q \
    && apt-get install -y curl mcrypt gnupg build-essential software-properties-common wget vim zip unzip git

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libpq-dev\
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd iconv zip pdo_mysql

RUN curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /home/default/app/
COPY . /home/default/app/
CMD [ "php", "artisan", "serve", "--host=0.0.0.0", "--port=80" ]
