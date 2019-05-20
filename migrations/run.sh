#!/bin/bash

set -e

echo $*

echo "CREATE SCHEMA IF NOT EXISTS ${4}"
mysql -u ${1} -p${2} -h ${3} -e "CREATE SCHEMA IF NOT EXISTS ${4}" 1> /dev/null 2>&1

echo "DB_USER=\"${1}\" DB_PASSWORD=\"${2}\" DB_HOST=\"${3}\" DB_DATABASE=\"${4}\""
DB_USER=${1} DB_PASSWORD=${2} DB_HOST=${3} DB_DATABASE=${4} npm run knex migrate:latest
DB_USER=${1} DB_PASSWORD=${2} DB_HOST=${3} DB_DATABASE=${4} npm run knex seed:run

# npm run knex migrate:latest
# npm run knex seed:run

# DB_USER=root DB_PASSWORD=admin DB_HOST=db DB_DATABASE=db_cookie_project npm run knex migrate:latest
# DB_USER=root DB_PASSWORD=admin DB_HOST=db DB_DATABASE=db_cookie_project npm run knex seed:run
