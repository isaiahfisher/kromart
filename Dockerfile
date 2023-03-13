FROM composer as vendor
WORKDIR /app
COPY . .
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-scripts \
    --prefer-dist

FROM node:16 as frontend
WORKDIR /app
COPY . .
COPY --from=vendor --chown=nginx:nginx /app/vendor /app/vendor
RUN npm install
RUN npm run build

FROM alpine as laravel-vue
ENV SHELL="/bin/sh"
ENV PHP_INI_DIR="/etc/php81"
ENV PM="dynamic"
ENV PM_MAX_CHILDREN="10"
ENV PM_START_SERVERS="5"
ENV PM_MIN_SPARE_SERVERS="1"
ENV PM_MAX_SPARE_SERVERS="5"
ENV PM_PROCESS_IDLE_TIMEOUT="10s"
ENV PHP_INI_MEMORY_LIMIT=128M
ARG DEPS="\
        ca-certificates \
        curl \
        nginx \
        php81 \
        php81-bcmath \
        php81-bz2 \
        php81-calendar \
        php81-ctype \
        php81-curl \
        php81-dom \
        php81-exif \
        php81-fileinfo \
        php81-fpm \
        php81-ftp \
        php81-iconv \
        php81-json \
        php81-ldap \
        php81-mbstring \
        php81-opcache \
        php81-openssl \
        php81-pcntl \
        php81-pdo_pgsql \
        php81-pecl-redis \
        php81-phar \
        php81-posix \
        php81-session \
        php81-shmop \
        php81-simplexml \
        php81-sockets \
        php81-sysvmsg \
        php81-sysvsem \
        php81-sysvshm \
        php81-tokenizer \
        php81-xml \
        php81-xmlreader \
        php81-xmlwriter \
        php81-zip \
        php81-zlib"
RUN apk --no-cache add $DEPS
RUN mkdir -p /run/nginx
RUN chown -R nginx:nginx /run/nginx/ /var/lib/nginx/ ${PHP_INI_DIR}/conf.d/ 
RUN ln -sf /usr/bin/php81 /usr/bin/php
COPY php-fpm.conf ${PHP_INI_DIR}/php-fpm.conf
COPY www.conf ${PHP_INI_DIR}/php-fpm.d/www.conf
COPY php.ini ${PHP_INI_DIR}/php.ini
COPY nginx.conf /etc/nginx/nginx.conf
COPY entrypoint.sh /entrypoint
EXPOSE 8080
ENTRYPOINT [ "/entrypoint" ]
ONBUILD USER nginx:nginx
ONBUILD WORKDIR /app
ONBUILD COPY --chown=nginx:nginx . /app

FROM laravel-vue
WORKDIR /app
COPY --chown=nginx:nginx /bootstrap/app.php /app/bootstrap/app.php
COPY --from=frontend --chown=nginx:nginx /app/public /app/public
COPY --from=vendor --chown=nginx:nginx /app/vendor /app/vendor
