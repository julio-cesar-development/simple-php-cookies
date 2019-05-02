FROM ubuntu:18.04

ENV DEBIAN_FRONTEND=noninteractive

ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update -qq && \
    apt-get install -y -qq \
    tzdata \
    apt-transport-https \
    ca-certificates \
    curl apt-utils git wget zip \
    gnupg-agent \
    software-properties-common \
    vim

RUN apt-get install -y -qq apache2

RUN apt-get install -y -qq php7.2 libapache2-mod-php7.2 \
    php7.2-dev php7.2-mbstring php7.2-mysql php7.2-zip \
    php7.2-curl php7.2-json php7.2-memcached php7.2-pdo

RUN a2enmod php7.2 && a2enmod rewrite && a2dismod mpm_event && a2enmod mpm_prefork
# RUN phpenmod mbstring zip curl json memcached
RUN for file in $(ls /etc/php/7.2/mods-available/); do phpenmod "$(echo $file |cut -d'.' -f1)"; done

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN curl -s https://getcomposer.org/installer | php && \
    chmod +x composer.phar && mv composer.phar /usr/local/bin/composer

RUN cd /var/www/html/

RUN composer install

ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV APACHE_PID_FILE /var/run/apache2/apache2.pid
ENV APACHE_RUN_DIR /var/run/apache2
ENV APACHE_LOCK_DIR /var/lock/apache2
ENV APACHE_LOG_DIR /var/log/apache2

RUN mkdir -p $APACHE_RUN_DIR
RUN mkdir -p $APACHE_LOCK_DIR
RUN mkdir -p $APACHE_LOG_DIR

# RUN rm /var/www/html/index.html
RUN chown -R $APACHE_RUN_USER:$APACHE_RUN_USER /var/www/html/

EXPOSE 80
CMD ["apache2", "-DFOREGROUND"]

# build this image
# docker image build -f Dockerfile-front -t app-login .

# run this image with a container
# docker container run --name app-login -p 8090:80 app-login
# docker container run -it --name app-login -p 8090:80 app-login bash

# ls -lt /var/www/html/
