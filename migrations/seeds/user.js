const process = require('process');
const schema = process.env.DB_DATABASE || 'db_cookie_project';
console.log(schema);

exports.seed = function(knex, Promise) {
  return knex('User').del()
    .then(function () {
      return knex('User').insert([
        {
          username: 'admin',
          password: knex.raw('MD5(\'admin\')')
        },
      ]);
    });
};
