<?php
  $dsn = "mysql:host=db;dbname=db_cookie_project";
  $dbuser = "root";
  $dbpass = "admin";

  try{
    $pdo = new PDO($dsn, $dbuser, $dbpass);
    echo 'Connected!';
  }catch (PDOException $e){
    echo $e->getMessage();
  }
