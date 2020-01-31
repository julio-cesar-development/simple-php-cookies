FROM juliocesarmidia/apache_php_base:v18.04
LABEL maintainer="julio@blackdevs.com.br"

RUN apt-get update && apt-get install netcat -y && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN composer install

EXPOSE 80
CMD ["apache2", "-DFOREGROUND"]

# Build this image
# docker image build -f Dockerfile -t app .

# Run this image
# docker container run --name app -p 80:80 app
# docker container run -it --name app -p 80:80 app bash