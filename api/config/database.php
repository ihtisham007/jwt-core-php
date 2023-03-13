<?php

class DatabaseService {
 //mysql connection 
 private $db_host = "127.0.0.1";
 private $db_name = "jwtcore";
 private $db_user = "root";
 private $db_password = "";
 public $conn;
 // return conn for getter and setter
 public function getConnection(){

   $this->conn = null;
   //creating mysqli new conenction hostName, Database User Name, Database Password and Database 
   $this->conn= new mysqli($this->db_host,$this->db_user,$this->db_password,$this->db_name);
   if($this->conn){
      echo "connected ";
   }else{
      echo "not connected";
   }
   //this connection will use for quring from database
   return $this->conn;
 }
}
?>