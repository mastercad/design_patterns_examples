FROM php:8.3.0-fpm-alpine3.18

LABEL AUTHOR="Andreas Kempe <andreas.kempe@byte-artist.de>"

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN apk --no-cache add libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

WORKDIR /usr/src/app

CMD ["php-fpm","-F"]
