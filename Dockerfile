FROM juliocesarmidia/ubuntu_base:v18.04
LABEL maintainer="julio@blackdevs.com.br"

RUN apt-get install -y -qq apache2

RUN apt-get install -y -qq php7.2 libapache2-mod-php7.2 \
    php7.2-dev php7.2-mbstring php7.2-mysql php7.2-zip \
    php7.2-curl php7.2-json php7.2-memcached php7.2-pdo

RUN a2enmod php7.2 && a2enmod rewrite && a2dismod mpm_event && a2enmod mpm_prefork
RUN for file in $(ls /etc/php/7.2/mods-available/); do phpenmod "$(echo $file |cut -d'.' -f1)"; done

WORKDIR /var/www/html/
RUN cd /var/www/html/

COPY . /var/www/html/

RUN mv /var/www/html/000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN curl -s https://getcomposer.org/installer | php && \
    chmod +x composer.phar && \
    mv composer.phar /usr/local/bin/composer

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

RUN rm /var/www/html/index.html
RUN chown -R $APACHE_RUN_USER:$APACHE_RUN_USER /var/www/html/

EXPOSE 80
CMD ["apache2", "-DFOREGROUND"]

# Build this image
# docker image build -f Dockerfile -t app .

# Run this image
# docker container run --name app -p 80:80 app
# docker container run -it --name app -p 80:80 app bash