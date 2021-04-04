#!/bin/bash

# set -e

echo "ARGUMENTS"
echo "$@"

cd /migrations

echo "MYSQL_USER=\"${MYSQL_USER}\" MYSQL_PASSWORD=\"${MYSQL_PASSWORD}\" MYSQL_HOST=\"${MYSQL_HOST}\" MYSQL_DATABASE=\"${MYSQL_DATABASE}\""

echo "creating schema ${MYSQL_DATABASE}"
mysql -u ${MYSQL_USER} -p${MYSQL_PASSWORD} -h ${MYSQL_HOST} -e "CREATE SCHEMA IF NOT EXISTS ${MYSQL_DATABASE}" 1> /dev/null 2>&1

echo "running arguments"
exec "$@"

echo "EXIT CODE $?"

# => migrations
# npm run knex migrate:make create_user

# npm run knex migrate:latest
# npm run knex migrate:rollback

# => seeds
# npm run knex seed:make user
# npm run knex seed:run
