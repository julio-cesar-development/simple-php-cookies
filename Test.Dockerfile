FROM juliocesarmidia/php_composer_apache:7.4
LABEL maintainer="julio@blackdevs.com.br"

RUN apt-get update -yqq && \
    apt-get install ssh git zip unzip -yqq && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN composer install

CMD ["./vendor/bin/phpunit", "--bootstrap", "vendor/autoload.php", "--testdox", "tests/"]
