
# Simple PHP login project using cookies, and unit tests with PHP Unit

[![Build Status](https://travis-ci.org/julio-cesar-development/simple-php-cookies.svg)](https://travis-ci.org/julio-cesar-development/simple-php-cookies)
![License](https://badgen.net/badge/license/MIT/blue)
[![GitHub Status](https://badgen.net/github/status/julio-cesar-development/simple-php-cookies)](https://github.com/julio-cesar-development/simple-php-cookies)

## Instructions

### Running with docker

> Run the application

```bash
# start db and app
docker-compose up db app

# start db and app in daemon mode
docker-compose up -d db app

# build and start db and app
docker-compose up --build db app

# build and start db and app in daemon mode
docker-compose up -d --build db app
```

> Migrations

```bash
# docker-compose
docker-compose up -d migrations

# build the migrations image and run the migrations container
docker image build \
  -f Migrations.Dockerfile \
  -t migrations .

docker container run \
  --rm \
  -v ${PWD}/migrations/node_modules \
  -v ${PWD}/migrations:/migrations \
  --env MYSQL_HOST=db \
  --env MYSQL_DATABASE=db_cookie_project \
  --env MYSQL_USER=root \
  --env MYSQL_PASSWORD=admin \
  migrations
```

> Tests

```bash
# build the test image and run the test container
docker image build \
  -f Test.Dockerfile \
  -t test .

docker container run --rm test
```

-----------------

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
