<?php
    class Database {
        // DB Params
         $host = 'nnsgluut5mye50or.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
   $db_name = 'zzjr2yzlkkznr5gg';
   $username = 'r7iz5wrci1spczw2';
   $password = 'y1qnfwttrqsdtg20';
   $conn;


        // DB Connect
    public function connect() {
        $this->conn = null;
  
        try { 
          $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
          $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
          echo 'Connection Error: ' . $e->getMessage();
        }
  
        return $this->conn;
      }
    }
