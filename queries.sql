CREATE DATABASE IF NOT EXISTS db_cookie_project;

USE db_cookie_project;

DROP TABLE IF EXISTS User;

CREATE TABLE IF NOT EXISTS User (
  codigo INTEGER NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  hash VARCHAR(255),
  PRIMARY KEY(codigo)
);

INSERT INTO
  User (username, password)
VALUES
  ('admin', MD5('admin'));