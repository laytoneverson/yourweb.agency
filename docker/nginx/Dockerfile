FROM nginx:alpine

ARG SYMFONY_ENV=prod
ARG PHP_UPSTREAM_CONTAINER=php-fpm
ARG PHP_UPSTREAM_PORT=9000

ADD ./nginx.conf /etc/nginx/
ADD ./sites/ /etc/nginx/sites-available/

RUN apk update \
    && apk upgrade \
    && apk add --no-cache bash \
    && adduser -D -H -u 1000 -s /bin/bash www-data

# Set upstream conf and remove the default conf
RUN echo "upstream php-upstream { server $PHP_UPSTREAM_CONTAINER:$PHP_UPSTREAM_PORT; }" > /etc/nginx/conf.d/upstream.conf \
    && rm /etc/nginx/conf.d/default.conf

CMD ["nginx"]

EXPOSE 80 443
