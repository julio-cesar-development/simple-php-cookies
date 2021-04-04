FROM juliocesarmidia/php_composer_apache:7.4
LABEL maintainer="julio@blackdevs.com.br"

RUN apt-get update -yqq && \
    apt-get install ssh git zip unzip -yqq && \
    rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
  pdo pdo_mysql && \
  docker-php-ext-enable pdo pdo_mysql

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN composer install --no-dev

EXPOSE 80
CMD ["apache2", "-DFOREGROUND"]
