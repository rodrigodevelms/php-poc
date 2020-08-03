#FROM php:8.0-rc-fpm-alpine

FROM php:7.4.8-fpm-alpine

RUN apk add --no-cache --virtual .build-deps \
    $PHPIZE_DEPS \
    curl-dev \
    oniguruma-dev \
    libtool \
    libxml2-dev \
    postgresql-dev \
    autoconf \
    g++ \
    make \
    sqlite-dev && \
    apk add --no-cache \
        curl \
        git \
        postgresql-libs \
        libintl \
        icu \
        icu-dev \
        libzip-dev && \
    docker-php-ext-install \
        bcmath \
        curl \
        iconv \
        mbstring \
        pdo \
        pdo_pgsql \
        pcntl \
        tokenizer \
        xml \
        zip \
        intl 

RUN pecl channel-update pecl.php.net && \
	pecl install xdebug-2.9.1 && \
	curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    apk del -f .build-deps
    
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

WORKDIR /var/www
