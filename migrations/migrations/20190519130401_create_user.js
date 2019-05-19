const process = require('process');
const schema = process.env.DB_DATABASE || 'db_cookie_project';
console.log(schema);

exports.up = function(knex, Promise) {
  return knex.schema.withSchema(schema).createTable('User', table => {
    table.increments('codigo').primary();
    table.string('username', 255).notNullable();
    table.string('password', 255).notNullable();
    table.string('hash', 255);
  })
    .then((data) => {
      const [OkPacket] = data;
      console.log('affectedRows => ', OkPacket.affectedRows);
    })
    .catch((err) => {
      console.log(err)
    });
};

exports.down = function(knex, Promise) {
  return knex.schema.withSchema(schema).dropTable('User')
    .then((data) => {
      const [OkPacket] = data;
      console.log('affectedRows => ', OkPacket.affectedRows);
    })
    .catch((err) => {
      console.log(err)
    });
};
