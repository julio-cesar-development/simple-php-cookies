const process = require('process');
const schema = process.env.MYSQL_DATABASE || 'db_cookie_project';
console.log('schema', schema);

exports.up = knex => knex.schema.withSchema(schema)
  .createTable('User', table => {
    table.increments('codigo').primary();
    table.string('username', 255).notNullable();
    table.string('password', 255).notNullable();
    table.string('hash', 255);
  });

exports.down = knex => knex.schema.withSchema(schema).dropTable('User');
