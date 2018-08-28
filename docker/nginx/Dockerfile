FROM nginx:1.15-alpine

RUN set -x \
	&& addgroup -g 82 -S www-data \
	&& adduser -u 82 -D -S -G www-data www-data

RUN mkdir -p /var/www/application/public && chown 82:82 /var/www/application/public

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/nginx.site.conf /etc/nginx/conf.d/default.conf