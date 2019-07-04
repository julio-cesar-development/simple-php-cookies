<?php
  class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct() {
      $this->host = !empty(getenv('DB_HOST')) ? getenv('DB_HOST') : '127.0.0.1';
      $this->db_name = !empty(getenv('DB_DATABASE')) ? getenv('DB_DATABASE') : 'db_cookie_project';
      $this->username = !empty(getenv('DB_USER')) ? getenv('DB_USER') : 'root';
      $this->password = !empty(getenv('DB_PASSWORD')) ? getenv('DB_PASSWORD') : 'admin';
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