#!/bin/bash

# set -e

echo "ARGUMENTS"
echo "$@"

cd /migrations

echo "DB_USER=\"${DB_USER}\" DB_PASSWORD=\"${DB_PASSWORD}\" DB_HOST=\"${DB_HOST}\" DB_DATABASE=\"${DB_DATABASE}\""

echo "creating schema ${DB_DATABASE}"
mysql -u ${DB_USER} -p${DB_PASSWORD} -h ${DB_HOST} -e "CREATE SCHEMA IF NOT EXISTS ${DB_DATABASE}" 1> /dev/null 2>&1

echo "running arguments"
exec "$@"

echo "EXIT CODE $?"

# npm run knex migrate:latest
# npm run knex seed:run

# npm run knex migrate:latest
# npm run knex seed:run
