
# Simple PHP login project using cookies, and unit tests with PHP Unit

[![Build Status](https://badgen.net/travis/julio-cesar-development/simple-php-cookies?icon=travis&color=green)](https://travis-ci.org/julio-cesar-development/simple-php-cookies)
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
# with docker-compose
docker-compose up migrations

# build the migrations image and run the migrations container
docker image build \
  -f Dockerfile-migrations \
  -t migrations \
  --build-arg DB_HOST=db \
  --build-arg DB_DATABASE=db_cookie_project \
  --build-arg DB_USER=root \
  --build-arg DB_PASSWORD=admin \
  . && \
  docker container run \
  --rm \
  -v $(pwd)/migrations/node_modules \
  -v $(pwd)/migrations:/migrations \
  migrations
```

> Tests

```bash
# with docker-compose
docker-compose up test

# build the test image and run the test container
docker image build \
  -f Dockerfile-test \
  -t test \
  . && \
  docker container run \
  --rm \
  test
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
