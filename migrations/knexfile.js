const process = require('process');

console.log('process.env.MYSQL_HOST', process.env.MYSQL_HOST);
console.log('process.env.MYSQL_DATABASE', process.env.MYSQL_DATABASE);
console.log('process.env.MYSQL_USER', process.env.MYSQL_USER);
console.log('process.env.MYSQL_PASSWORD', process.env.MYSQL_PASSWORD);

module.exports = {
  client: 'mysql',
  connection: {
    host : process.env.MYSQL_HOST || '127.0.0.1',
    database : process.env.MYSQL_DATABASE || 'db_cookie_project',
    user : process.env.MYSQL_USER || 'root',
    password : process.env.MYSQL_PASSWORD || 'admin',
  },
  pool: {
    min: 1,
    max: 10000
  },
  migrations: {
    tableName: 'migrations'
  },
};
