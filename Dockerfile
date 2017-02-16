FROM alpine:edge

MAINTAINER jovani <vojalf@gmail.com>

RUN apk --update add --no-cache \
    php7 \
    php7-xml \
    php7-xsl \
    php7-pdo_mysql \
    php7-mcrypt \
    php7-curl \
    php7-json \
    php7-fpm \
    php7-phar \
    php7-openssl \
    php7-mysqli \
    php7-ctype \
    php7-opcache \
    php7-mbstring \
    php7-mongodb \
    curl \
    mongodb \
    --repository http://dl-4.alpinelinux.org/alpine/edge/testing
#    nginx \
#    supervisor \

#RUN mkdir -p /etc/nginx
RUN mkdir -p /var/run/php-fpm
#RUN mkdir -p /var/log/supervisor
RUN mkdir -p /scripts

#ADD run.sh /scripts/run.sh
#RUN chmod 755 /scripts/*.sh

#ADD nginx.conf /etc/nginx/nginx.conf
#ADD nginx-default /etc/nginx/sites-available/default

#ADD php-fpm.conf /etc/php7/php-fpm.conf
RUN ln -s /usr/bin/php7 /usr/bin/php
#RUN mkdir -p /etc/supervisor.d
#ADD supervisord-nginx.conf /etc/supervisor/conf.d/supervisord-nginx.conf
#ADD supervisord-php.ini /etc/supervisor.d/supervisord-php.ini

#VOLUME ["/var/www"]

#WORKDIR /var/www
#VOLUME /data/db

WORKDIR /app
ADD . /app

#EXPOSE 9000 80 443 9001
EXPOSE 9000

#CMD ["/scripts/run.sh"]
ENTRYPOINT ["php", "hello.php"]