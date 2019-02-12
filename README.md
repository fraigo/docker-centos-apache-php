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


## Centos7, Apache 2.4, PHP 5.5

Create base image (php55-apache24-base)

`docker image build -t php55-apache24-base ./php55-apache24-base`

Create image with extra components, custom config (`.custom-config/`) and web application code (`.www/` folder)

`docker image build -t php55-apache24 ./php55-apache24`

Run image

`docker run -p 8080:8080 php55-apache24`

Open local web server

`http://localhost:8080/`