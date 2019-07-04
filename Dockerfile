FROM juliocesarmidia/apache_php_base:v18.04
LABEL maintainer="julio@blackdevs.com.br"

WORKDIR /var/www/html/
COPY . /var/www/html/

RUN mv /var/www/html/000-default.conf /etc/apache2/sites-enabled/000-default.conf

RUN composer install

EXPOSE 80
CMD ["apache2", "-DFOREGROUND"]

# Build this image
# docker image build -f Dockerfile -t app .

# Run this image
# docker container run --name app -p 80:80 app
# docker container run -it --name app -p 80:80 app bash