#! /bin/sh

/usr/sbin/php-fpm81 -D
/usr/sbin/nginx -c /etc/nginx/nginx.conf

exec "$@"
