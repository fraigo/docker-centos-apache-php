# docker-centos-apache-php

Create Docker images for Web server based on Centos7, Apache 2.4, PHP 7.1


## Centos7, Apache 2.4, PHP 7.1

Create base image (php71-apache24-base)

`docker image build -t php71-apache24-base ./php71-apache24-base`

Create image with extra components, custom config (`.custom-config/`) and web application code (`.www/` folder)

`docker image build -t php71-apache24 ./php71-apache24`

Run image

`docker run -p 8080:8080 php71-apache24`

Open local web server

`http://localhost:8080/`

### PHP 7.1 Public docker image

https://hub.docker.com/r/franciscoigor/php71-apache24-centos7

## Centos7, Apache 2.4, PHP 5.5

Create base image (php55-apache24-base)

`docker image build -t php55-apache24-base ./php55-apache24-base`

Create image with extra components, custom config (`.custom-config/`) and web application code (`.www/` folder)

`docker image build -t php55-apache24 ./php55-apache24`

Run image

`docker run -p 8080:8080 php55-apache24`

Open local web server

`http://localhost:8080/`

### PHP 5.5 Public docker image

https://hub.docker.com/r/franciscoigor/php55-apache24-centos7

## Docker-compose example

A common PHP development environment with :

* PHP 7.1 / Apache 2.4 / Centos7
  * `phpapp` container
  * HTTP Port `8080`
* MariaDB 10.3
  * `mariadb` container
* PHPMyAdmin
  * `myadmin` container
  * HTTP port `8082`

### Run containers

`docker-compose up -d`

### Stop containers

`docker-compose stop`

### Unload containers

`docker-compose down`

Access containers: