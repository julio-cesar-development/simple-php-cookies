<?php
  class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
      $this->host = getenv('DB_HOST') ? getenv('DB_HOST') : '127.0.0.1';
      $this->db_name = getenv('DB_DATABASE') ? getenv('DB_DATABASE') : 'db_cookie_project';
      $this->username = getenv('DB_USER') ? getenv('DB_USER') : 'root';
      $this->password = getenv('DB_PASSWORD') ? getenv('DB_PASSWORD') : 'admin';
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