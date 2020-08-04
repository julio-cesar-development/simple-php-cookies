<?php
  class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
      $this->host = !empty(getenv('MYSQL_HOST')) ? getenv('MYSQL_HOST') : '127.0.0.1';
      $this->db_name = !empty(getenv('MYSQL_DATABASE')) ? getenv('MYSQL_DATABASE') : 'db_cookie_project';
      $this->username = !empty(getenv('MYSQL_USER')) ? getenv('MYSQL_USER') : 'root';
      $this->password = !empty(getenv('MYSQL_PASSWORD')) ? getenv('MYSQL_PASSWORD') : 'admin';
      $this->conn = null;
    }

    public function connect() {
      try {
        $dsn = "mysql:host=$this->host;dbname=$this->db_name";
        $this->conn = new PDO($dsn, $this->username, $this->password);
      } catch(PODException $err) {
        echo 'Connection Error: '.$err->GetMessage();
      }
      return $this->conn;
    }
  }
?>