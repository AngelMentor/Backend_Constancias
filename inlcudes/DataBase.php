<?php 

    class DataBase{
      private  $servername = "localhost";
      private  $username = "root";
      private  $password = "mentor123"; 
      private  $dbname = "ultimaenerser"; 
      public $conn;

      

      public function getConnection(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        } else {
        }

        return $this->conn;
      }

    }

    
?>