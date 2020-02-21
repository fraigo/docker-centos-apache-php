# Based on Apache2.4/Centos6 Dockerfile
# https://github.com/CentOS/CentOS-Dockerfiles/blob/master/httpd/centos6/Dockerfile
FROM centos:centos6

RUN yum -y update; yum clean all
RUN yum -y install httpd

ENV PHP_VERSION=5.3 \
    PHP_VER_SHORT="53" \
    YUM_PREFIX="" \
    NAME=php

ENV PATH=$PATH:/opt/rh/php${PHP_VER_SHORT}/root/usr/bin

ENV SUMMARY="Platform for building and running PHP $PHP_VERSION applications" \
    DESCRIPTION="Centos7/Apache2.4/PHP$PHP_VERSION server"

LABEL summary="${SUMMARY}" \
      description="${DESCRIPTION}" \
      name="centos7-${NAME}-${PHP_VER_SHORT}" \
      version="${PHP_VERSION}" \
      help="For more information visit https://hub.docker.com/r/centos/httpd-24-centos7" \
      usage="docker image build -t php-apache ./" \
      maintainer="Francisco Igor <franciscoigor@gmail.com>"

USER root


# Install Apache httpd and PHP
RUN yum install -y centos-release-scl 
#  php${PHP_VER_SHORT}-pdo php${PHP_VER_SHORT}-opcache  php${PHP_VER_SHORT}-gmp php${PHP_VER_SHORT}-pecl-apcu   
RUN INSTALL_PKGS="php${YUM_PREFIX} php${YUM_PREFIX}-mysql php${YUM_PREFIX}-pgsql php${YUM_PREFIX}-bcmath \
                  php${YUM_PREFIX}-gd php${YUM_PREFIX}-intl php${YUM_PREFIX}-ldap php${YUM_PREFIX}-mbstring \
                  php${YUM_PREFIX}-process php${YUM_PREFIX}-soap php${YUM_PREFIX}-xml \
                  httpd24-mod_ssl" && \
    yum install -y --setopt=tsflags=nodocs $INSTALL_PKGS --nogpgcheck
RUN yum clean all -y

ENV PHP_CONTAINER_SCRIPTS_PATH=/usr/share/container-scripts/php/ \
    APP_DATA=${APP_ROOT}/src \
    PHP_DEFAULT_INCLUDE_PATH=/opt/rh/php${PHP_VER_SHORT}/root/usr/share/pear \
    PHP_SYSCONF_PATH=/etc/opt/rh/php${PHP_VER_SHORT} \
    PHP_HTTPD_CONF_FILE=php${PHP_VER_SHORT}-php.conf \
    HTTPD_CONFIGURATION_PATH=${APP_ROOT}/etc/conf.d \
    HTTPD_MAIN_CONF_PATH=/etc/httpd/conf \
    HTTPD_MAIN_CONF_D_PATH=/etc/httpd/conf.d \
    HTTPD_VAR_RUN=/var/run/httpd \
    HTTPD_DATA_PATH=/var/www \
    HTTPD_DATA_ORIG_PATH=/opt/rh/httpd24/root/var/www \
    HTTPD_VAR_PATH=/opt/rh/httpd24/root/var \
    SCL_ENABLED=php${PHP_VER_SHORT}


ENV PHP_INI=/etc/php.ini

# RUN sed -i 's/^short_open_tag = Off/short_open_tag = On/g' $PHP_INI
RUN sed -i 's/^upload_max_filesize = 2M/upload_max_filesize = 50M/' $PHP_INI
RUN sed -i 's/^post_max_size = 8M/post_max_size = 50M/' $PHP_INI
# RUN sed -i 's/^default_socket_timeout = 60/default_socket_timeout = 120/' $PHP_INI


# php composer
WORKDIR /opt/rh/php${PHP_VER_SHORT}/root/usr/bin
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN rm composer-setup.php
RUN echo 'alias composer="php /opt/rh/php${PHP_VER_SHORT}/root/usr/bin/composer.phar"' >> ~/.bashrc


WORKDIR /var/www/html/


EXPOSE 80

RUN echo "#!/usr/bin/env bash" > /start.sh
RUN echo "echo Starting server $(date)..." > /start.sh
RUN echo "#exec /usr/sbin/apachectl -D FOREGROUND" >> /start.sh
RUN chmod -v +x /start.sh

CMD ["/usr/sbin/apachectl","-D","FOREGROUND"]
