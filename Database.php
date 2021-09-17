<?php
    class Database {
        // DB Params
         $host = 'us-cdbr-east-04.cleardb.com';
   $db_name = 'heroku_abde6316f609ed5';
   $username = 'b4a84a4b9166f9';
   $password = '8e08be0f';
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
