
<?php

  class Database {

    private $host = 'localhost';
    private $db_name = 'db_cookie_project';
    private $username = 'root';
    private $password = 'admin';
    private $conn;


    public function connect () {
      $this->conn = null;

      try{

        // mysql: host='host'; dbname='dbname', 'username', 'password'
        $this->conn = new PDO( 'mysql: host='.$this->host.'; dbname='.$this->db_name.'', ''.$this->username.'', ''.$this->password.'' );

        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      }catch (PODException $err){

        echo 'Connection Error: '.$err->GetMessage();

      }

      return $this->conn;

    }


  }

?>