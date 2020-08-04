exports.seed = (knex) => knex('User').del()
  .then(() => knex('User').insert([
    {
      username: 'admin',
      password: knex.raw('MD5(\'admin\')')
    }, {
      username: 'test',
      password: knex.raw('MD5(\'test\')')
    }, {
      username: 'dev',
      password: knex.raw('MD5(\'dev\')')
    },
  ])
);
