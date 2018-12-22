FROM alpine:3.8
LABEL Maintainer="Tim de Pater <code@trafex.nl>" \
      Description="Lightweight container with Nginx 1.14 & PHP-FPM 7.2 based on Alpine Linux."
COPY ./composer /usr/bin
RUN set -xe \
    &&  sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/' /etc/apk/repositories \
    && apk add --update --no-cache \
    ca-certificates \
    curl \
    openssh-client \
    libmemcached-libs \
    libevent \
    libssl1.0 \
    musl \
    yaml \
    php7 \
    php7-apcu \
    php7-bcmath \
    php7-ctype \
    php7-curl \
    php7-gd \
    php7-dom \
    php7-fileinfo \
    php7-iconv \
    php7-intl \
    php7-json \
    php7-openssl \
    php7-opcache \
    php7-mbstring \
    php7-memcached \
    php7-mysqlnd \
    php7-mysqli \
    php7-pcntl \
    php7-pgsql \
    php7-pdo_mysql \
    php7-pdo_pgsql \
    php7-pdo_sqlite \
    php7-phar \
    php7-posix \
    php7-session \
    php7-simplexml \
    php7-soap \
    php7-sockets \
    php7-sodium \
    php7-tokenizer \
    php7-xml \
    php7-xmlreader \
    php7-xmlwriter \
    php7-yaml \
    php7-zip \
    php7-zlib \
    bash nginx supervisor curl php-fpm php-xsl \
    && apk del --purge *-dev \
    && rm -rf /var/cache/apk/* /tmp/* /usr/share/man /usr/share/php7 \
    && cd /etc/php7 \
   # - config PHP
    && { \
    echo "upload_max_filesize=100M"; \
    echo "post_max_size=108M"; \
    echo "memory_limit=1024M"; \
    echo "date.timezone=Asia/Shanghai"; \
    } | tee conf.d/99-overrides.ini \
    # - config timezone
    && ln -sf /usr/share/zoneinfo/Asia/Shanghai /etc/localtime \
    && echo "Asia/Shanghai" > /etc/timezone \
    && apk add --no-cache  autoconf file g++ gcc libc-dev make pkgconf re2c php7-dev php7-pear libevent-dev openssl-dev \
    && apk add --no-cache  --virtual .phpize-deps  \
#    && apk add --no-cache --allow-untrusted  gnu-libiconv \
    && sed -i 's/^exec $PHP -C -n/exec $PHP -C/g' $(which pecl) \
    && pecl channel-update pecl.php.net \
    && pecl install event \
    && echo "extension=event.so" > /etc/php7/conf.d/01_event.ini \
    && pecl install swoole \
    && echo "extension=swoole.so" > /etc/php7/conf.d/01_swoole.ini \
    && pecl install redis \
    && echo "extension=redis.so" > /etc/php7/conf.d/01_redis.ini \
    && apk del .phpize-deps  autoconf file g++ gcc libc-dev make \
    && apk del --purge *-dev \
    && rm -rf /usr/share/php7 \
    && rm -rf /tmp/* /var/cache/apk/* /usr/share/man \
# 安装composer
# Setup the Composer installer

&& composer config -g repo.packagist composer https://packagist.laravel-china.org \
 # Add application
&& mkdir -p /var/www/html

# Configure nginx
COPY config/nginx.conf /etc/nginx/nginx.conf
COPY ./cert /etc/nginx/
# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php7/php-fpm.d/zzz_custom.conf
COPY config/php.ini /etc/php7/conf.d/zzz_custom.ini
# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html
COPY ./src /var/www/html/

EXPOSE 80 443
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
