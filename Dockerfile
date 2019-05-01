FROM php:7.2-apache

WORKDIR /
COPY . /var/www/html/

RUN sudo apt-get update && \
    sudo apt-get install curl && \
    sudo apt-get install php-7.2.8 && \
    sudo curl -s https://getcomposer.org/installer | php

RUN sudo mv composer.phar /usr/local/bin/composer
RUN sudo composer install

# build this image
# docker image build -f Dockerfile-front -t app-login .

# run this image with a container
# docker container run --name app-login -p 8090:80 app-login
# docker container run -it --name app-login -p 8090:80 app-login bash

# ls -lt /var/www/html/
