FROM juliocesarmidia/php_composer_apache:7.4
LABEL maintainer="julio@blackdevs.com.br"

RUN apt-get update -yqq && \
    apt-get install ssh git zip unzip -yqq && \
    rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN composer install

CMD ["./vendor/bin/phpunit", "--bootstrap", "vendor/autoload.php", "--testdox", "tests/"]

# Build this image
# docker image build -f Test.Dockerfile -t juliocesarmidia/simple-app-test:latest .

# Run this image
# docker container run --rm --name simple-app-test juliocesarmidia/simple-app-test:latest
# docker container run --rm --name -it simple-app-test juliocesarmidia/simple-app-test:latest bash
