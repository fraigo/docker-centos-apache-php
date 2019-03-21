# Based on https://github.com/sclorg/s2i-php-container/blob/master/7.1/Dockerfile
FROM centos/httpd-24-centos7


ENV PHP_VERSION=5.5 \
    PHP_VER_SHORT=55 \
    NAME=php

ENV PATH=$PATH:/opt/rh/php${PHP_VER_SHORT}/root/usr/bin

ENV SUMMARY="Platform for building and running PHP $PHP_VERSION applications" \
    DESCRIPTION="Centos7/Apache2.4/PHP$PHP_VERSION server"

LABEL summary="${SUMMARY}" \
      description="${DESCRIPTION}" \
      name="centos7-${NAME}-${PHP_VER_SHORT}" \
      version="${PHP_VERSION}" \
      help="For more information visit https://hub.docker.com/r/franciscoigor/php55-apache24-centos7" \
      usage="docker image build -t php-apache ./" \
      maintainer="Francisco Igor <franciscoigor@gmail.com>"

USER root

RUN export

# Install Apache httpd and PHP
RUN yum install -y centos-release-scl 
RUN INSTALL_PKGS="php${PHP_VER_SHORT} php${PHP_VER_SHORT}-php php${PHP_VER_SHORT}-php-mysqlnd php${PHP_VER_SHORT}-php-pgsql php${PHP_VER_SHORT}-php-bcmath \
                  php${PHP_VER_SHORT}-php-gd php${PHP_VER_SHORT}-php-intl php${PHP_VER_SHORT}-php-ldap php${PHP_VER_SHORT}-php-mbstring php${PHP_VER_SHORT}-php-pdo \
                  php${PHP_VER_SHORT}-php-process php${PHP_VER_SHORT}-php-soap php${PHP_VER_SHORT}-php-opcache php${PHP_VER_SHORT}-php-xml \
                  php${PHP_VER_SHORT}-php-gmp php${PHP_VER_SHORT}-php-pecl-apcu httpd24-mod_ssl" && \
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

# Reset permissions of filesystem to default values
RUN rpm-file-permissions



