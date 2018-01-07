FROM php:7.1-fpm

RUN apt-get update \
  && apt-get install -y --no-install-recommends \
    curl \
    g++ \
    gifsicle \
    imagemagick \
    jpegoptim \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmagickwand-dev \
    libmcrypt-dev \
    libmemcached-dev \
    libpng12-dev \
    libpq-dev \
    libssl-dev \
    libz-dev \
    optipng \
    pngquant \
    zlib1g-dev \
  && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd \
    --enable-gd-native-ttf \
    --with-jpeg-dir=/usr/lib \
    --with-freetype-dir=/usr/include/freetype2 \
  && docker-php-ext-configure \
    intl \
  && docker-php-ext-install \
    pdo_mysql \
    gd \
    zip \
    bcmath \
    exif \
    intl \
    mcrypt

RUN pecl install -o -f redis \
    && pecl install imagick \
    && pecl install xdebug \
    && pecl install mongodb \
    && docker-php-ext-enable \
        redis \
        imagick \
        xdebug \
        mongodb \
    && rm -rf /tmp/pear

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
ADD laravel.ini /usr/local/etc/php/conf.d
ADD xlaravel.pool.conf /usr/local/etc/php-fpm.d/
COPY php71.ini /usr/local/etc/php/php.ini

RUN usermod -u 1000 www-data

WORKDIR /var/www

CMD ["php-fpm"]

EXPOSE 9000
