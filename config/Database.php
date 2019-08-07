<?php

class Database {
    // DB params
    private $host = 'localhost';
    private $db_name = 'vidly';
    private $username = 'shasini92';
    private $password = '12345678';
    private $conn;
    
    // DB Connect
    public function connect() {
        $this->conn = null;
        
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error: {$e->getMessage()}";
        }
        
        return $this->conn;
    }
}