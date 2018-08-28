FROM php:7.2-fpm-alpine3.7
ARG TIMEZONE
ARG APP_ENV

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone
RUN printf '[PHP]\ndate.timezone = "%s"\n', ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini
RUN printf '[PHP]\nupload_max_filesize = 126M\npost_max_size = 126M\n' > /usr/local/etc/php/conf.d/uploads.ini
RUN "date"

RUN  set -ex && \
    apk --no-cache add \
    zlib-dev \
    icu-dev

# Type docker-php-ext-install to see available extensions
RUN docker-php-ext-install pdo pdo_mysql zip intl hash opcache bcmath mbstring

RUN mkdir -p /var/www/application/ && chown 82:82 /var/www/application/


WORKDIR /var/www/application
