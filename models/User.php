<?php
  class User {
    public $conn;
    private $table;
    public $codigo;
    public $username;
    public $hash;

    public function __construct($db){
      $this->conn = $db;
      $this->table = __CLASS__; // Getting class name as table name
    }

    public function get_user () {
      $query = "select
                codigo, username, password, hash
                from {$this->table}
                where username = ?
                LIMIT 1";

      $stmt = $this->conn->prepare($query);

      // PDO binding position
      $stmt->bindParam(1, $this->username);
      $stmt->execute();
      $return = $stmt->fetch(PDO::FETCH_ASSOC);
      return $return;
    }

    public function put_userhash () {
      $query = "update
                {$this->table}
                set hash = ?
                where codigo = ?";

      $stmt = $this->conn->prepare($query);

      // PDO binding position
      $stmt->bindParam(1, $this->hash);
      $stmt->bindParam(2, $this->codigo);
      $stmt->execute();
      return $stmt;
    }
  }
?>