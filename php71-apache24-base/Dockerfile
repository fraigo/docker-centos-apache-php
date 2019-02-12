# Based on https://github.com/sclorg/s2i-php-container/blob/master/7.1/Dockerfile

FROM centos/httpd-24-centos7


ENV PHP_VERSION=7.1 \
    PHP_VER_SHORT=71 \
    NAME=php \
    PATH=$PATH:/opt/rh/rh-php71/root/usr/bin

ENV SUMMARY="Platform for building and running PHP $PHP_VERSION applications" \
    DESCRIPTION="Centos7/Apache2.4/PHP$PHP_VERSION server"

LABEL summary="${SUMMARY}" \
      description="${DESCRIPTION}" \
      name="centos7-${NAME}-${PHP_VER_SHORT}" \
      version="${PHP_VERSION}" \
      help="For more information visit https://hub.docker.com/r/franciscoigor/php71-apache24-centos7" \
      usage="docker image build -t php-apache ./" \
      maintainer="Francisco Igor <franciscoigor@gmail.com>"

USER root

RUN export

# Install Apache httpd and PHP
RUN yum install -y centos-release-scl 
RUN INSTALL_PKGS="rh-php71 rh-php71-php rh-php71-php-mysqlnd rh-php71-php-pgsql rh-php71-php-bcmath \
                  rh-php71-php-gd rh-php71-php-intl rh-php71-php-ldap rh-php71-php-mbstring rh-php71-php-pdo \
                  rh-php71-php-process rh-php71-php-soap rh-php71-php-opcache rh-php71-php-xml \
                  rh-php71-php-gmp rh-php71-php-pecl-apcu httpd24-mod_ssl" && \
    yum install -y --setopt=tsflags=nodocs $INSTALL_PKGS --nogpgcheck
RUN yum clean all -y

ENV PHP_CONTAINER_SCRIPTS_PATH=/usr/share/container-scripts/php/ \
    APP_DATA=${APP_ROOT}/src \
    PHP_DEFAULT_INCLUDE_PATH=/opt/rh/rh-php71/root/usr/share/pear \
    PHP_SYSCONF_PATH=/etc/opt/rh/rh-php71 \
    PHP_HTTPD_CONF_FILE=rh-php71-php.conf \
    HTTPD_CONFIGURATION_PATH=${APP_ROOT}/etc/conf.d \
    HTTPD_MAIN_CONF_PATH=/etc/httpd/conf \
    HTTPD_MAIN_CONF_D_PATH=/etc/httpd/conf.d \
    HTTPD_VAR_RUN=/var/run/httpd \
    HTTPD_DATA_PATH=/var/www \
    HTTPD_DATA_ORIG_PATH=/opt/rh/httpd24/root/var/www \
    HTTPD_VAR_PATH=/opt/rh/httpd24/root/var \
    SCL_ENABLED=rh-php71

# Reset permissions of filesystem to default values
RUN rpm-file-permissions

RUN echo "Running on http://localhost:8080"
