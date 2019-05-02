<?php
  class Database {
    private $host;
    private $db_name;
    private $username = 'root';
    private $password = 'admin';
    private $conn;

    public function connect () {
      $this->conn = null;
      $this->host = !empty(getenv('DB_HOST')) ? getenv('DB_HOST') : 'localhost';
      $this->db_name = !empty(getenv('DB_DATABASE')) ? getenv('DB_DATABASE') : 'db_cookie_project';

      try{
        // mysql: host='host'; dbname='dbname', 'username', 'password'
        $this->conn = new PDO('mysql: host='.$this->host.'; dbname='.$this->db_name.'', ''.$this->username.'', ''.$this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      }catch (PODException $err){
        echo 'Connection Error: '.$err->GetMessage();
      }
      return $this->conn;
    }
  }
?>