FROM php-apache-base

# Copy extra files to the image.
COPY ./www /var/www/html
COPY ./config-files /root/config

RUN cp -r /root/config/etc/ /
