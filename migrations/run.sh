#!/bin/bash

# set -e

# ENV DB_HOST=${DB_HOST}
# ENV DB_DATABASE=${DB_DATABASE}
# ENV DB_USER=${DB_USER}
# ENV DB_PASSWORD=${DB_PASSWORD}

cd /migrations

echo "CREATE SCHEMA IF NOT EXISTS ${DB_DATABASE}"
mysql -u ${DB_USER} -p${DB_PASSWORD} -h ${DB_HOST} -e "CREATE SCHEMA IF NOT EXISTS ${DB_DATABASE}" 1> /dev/null 2>&1

echo "DB_USER=\"${DB_USER}\" DB_PASSWORD=\"${DB_PASSWORD}\" DB_HOST=\"${DB_HOST}\" DB_DATABASE=\"${DB_DATABASE}\""
DB_USER=${DB_USER} DB_PASSWORD=${DB_PASSWORD} DB_HOST=${DB_HOST} DB_DATABASE=${DB_DATABASE} npm run knex migrate:latest
DB_USER=${DB_USER} DB_PASSWORD=${DB_PASSWORD} DB_HOST=${DB_HOST} DB_DATABASE=${DB_DATABASE} npm run knex seed:run

# npm run knex migrate:latest
# npm run knex seed:run

# DB_USER=root DB_PASSWORD=admin DB_HOST=db DB_DATABASE=db_cookie_project npm run knex migrate:latest
# DB_USER=root DB_PASSWORD=admin DB_HOST=db DB_DATABASE=db_cookie_project npm run knex seed:run
