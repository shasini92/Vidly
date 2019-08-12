<?php

class Genre {
    // DB Stuff
    private $conn;
    private $table = 'genres';
    
    // Properties
    public $id;
    public $name;
    
    
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {
        // Create a query
        $query = 'SELECT * FROM ' . $this->table;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        //Execute
        $stmt->execute();
        
        return $stmt;
    }
}