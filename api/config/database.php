<?php

class DatabaseService {
 
 private $db_host = "127.0.0.1";
 private $db_name = "jwtcore";
 private $db_user = "root";
 private $db_password = "";
 public $conn;

 public function getConnection(){

     $this->conn = null;

    $this->conn= new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
    if($this->conn){
       echo "connected ";
    }else{
       echo "not connected";
    }
   
    return $this->conn;
 }
}
?>