
# Simple PHP login project using cookies, and unit tests with PHP Unit

[![Build Status](https://badgen.net/travis/julio-cesar-development/simple-php-cookies?icon=travis&color=green)](https://travis-ci.org/julio-cesar-development/simple-php-cookies)
[![GitHub Status](https://badgen.net/github/status/julio-cesar-development/simple-php-cookies)](https://github.com/julio-cesar-development/simple-php-cookies)

## Instructions

### Running with docker

> Run the application

```bash
# it'll just start all services
docker-compose up

# it'll start all services in daemon mode
docker-compose up -d

# it'll build and start all services
docker-compose up --build

# it'll build and start all services in daemon mode
docker-compose up -d --build
```

> Tests

```bash
# it'll build the image and after run the test container
docker image build -f \
  Dockerfile-test -t \
  app-login-test . && \
  docker container run \
  --rm app-login-test
```

### Running appart

> Database

* Create a schema in a MySQL DB called db_cookie_project:

```mysql
CREATE DATABASE IF NOT EXISTS db_cookie_project;
```

* Through terminal:

```bash
mysql -u [mysql_user] -p[mysql_password] -h [mysql_host] -e "CREATE DATABASE IF NOT EXISTS db_cookie_project;"
```

* Run the file queries.sql through terminal:

```bash
mysql -u [mysql_user] -p[mysql_password] -h [mysql_host] db_cookie_project < queries.sql
```

> Running application

* Run this application through a server like apache, or even through the embedded PHP server like this:

```bash
php -S 0.0.0.0:80
```

> Tests

* For tests is required the following command to install the dependencies

```bash
composer install
```

* Then you can run the tests

```bash
./vendor/bin/phpunit --bootstrap vendor/autoload.php --testdox tests/
```

## Authors

* **Julio Cesar** - *Initial work*

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
