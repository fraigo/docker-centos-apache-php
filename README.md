# docker-centos-apache-php

Create Docker images for Web server based on Centos7, Apache 2.4, PHP 7.1


## Commands

Create Centos7, Apache 2.4, PHP 7.1 base image (php-apache-base)

`docker image build -t php-apache-base -f php-apache-base.Dockerfile ./`

Create Image with extra components, custom config and web application code

`docker image build -t php-apache -f php-apache.Dockerfile ./`

Run image

`docker run -p 8080:8080 php-apache`
