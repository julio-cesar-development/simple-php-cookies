const process = require('process');

module.exports = {
  client: 'mysql',
  connection: {
    host : process.env.DB_HOST || '127.0.0.1',
    database : process.env.DB_DATABASE || 'db_cookie_project',
    user : process.env.DB_USER || 'root',
    password : process.env.DB_PASSWORD || 'admin',
  },
  pool: {
    min: 1,
    max: 10000
  },
  migrations: {
    tableName: 'migrations'
  },
};

// npm run knex migrate:make create_user

// npm run knex migrate:latest
// npm run knex migrate:rollback


// npm run knex seed:make user

// npm run knex seed:run
