FROM php:8.0-alpine

LABEL maintainer="Othmane Moustaouda"

RUN apk update && \
    apk add \
        unzip \
        git \
        curl \
        file

# Install PHP extensions building deps. Deps will be removed right after after building the necessary extensions.
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS && \
    # Install pre-packaged PHP extensions
    docker-php-ext-install \
        pdo_mysql && \

    # Compile and install xdebug (without enabling it yet)
    pecl install xdebug && \
    # Cleanup building dependencies
    apk del -f .build-deps

# Flag for enabling/disabling xdebug (can be specified as option or in docker-compose.yml)
# Note: xdebug can have a considerable impact on PHP applications speed
# Default: enabled
ARG WITH_XDEBUG=true
RUN if [ $WITH_XDEBUG = "true" ]; then \
        docker-php-ext-enable xdebug && \
        mkdir -p /etc/php7/conf.d/; \
        echo "zend_extension=xdebug.so" > /etc/php7/conf.d/xdebug.ini; \
        echo "error_reporting = E_ALL" >> /etc/php7/conf.d/xdebug.ini; \
        echo "display_startup_errors = On" >> /etc/php7/conf.d/xdebug.ini; \
        echo "display_errors = On" >> /etc/php7/conf.d/xdebug.ini; \
        echo "xdebug.remote_enable=1" >> /etc/php7/conf.d/xdebug.ini; \
    fi;

# Allow PHP to open ports < 1023 (allowing the PHP built-in server to run as unpriviliged user)
RUN apk add --no-cache libcap && setcap 'cap_net_bind_service=+ep' /usr/local/bin/php

# Increase PHP memory limit
RUN echo 'memory_limit = 512M' >> /usr/local/etc/php/conf.d/docker-php-memory-limit.ini
