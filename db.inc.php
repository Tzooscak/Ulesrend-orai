<?php
    class DataBase{
      private $servername = "localhost";
      private $username = "gyakszi";
      private $password = "ggXaE4AsACzgdIY0";
      private $dbname = "ulesrend";  
      private $conn;
      
      public function dbSelect($sql){
        $result = $this->conn->query($sql);
        if($result->num_rows>0){
          return $result;
        }
        else{
          return NULL;
        }

      }
      function __construct() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
            }
        $this->conn =$conn;
      
    }
}
?>