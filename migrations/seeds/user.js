const process = require('process');
const schema = process.env.DB_DATABASE || 'db_cookie_project';

exports.seed = function(knex, Promise) {
  return knex('User').del()
    .then(function () {
      return knex('User').insert(
        [
          {
            username: 'admin',
            password: knex.raw('MD5(\'admin\')')
          },
          {
            username: 'test',
            password: knex.raw('MD5(\'test\')')
          },
          {
            username: 'dev',
            password: knex.raw('MD5(\'dev\')')
          },
        ]
      );
    });
};
