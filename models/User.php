<?php

class User{
    // DB Stuff
    private $conn;
    private $table = 'users';
    
    // Properties
    public $id;
    public $email;
    public $password;
    public $name;
    public $hashedPassword;
    
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function getLastUserId(){
        return $this->conn->lastInsertId();
    }
    
    // Read single user
    public function  read_single() {
        // Create a query
        $query = 'SELECT * FROM ' . $this->table . ' WHERE email = :email ';
    
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(':email', $this->email);
    
        //Execute
        $stmt->execute();
        
        return $stmt;
    }
    
    
    // Create a User
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
         SET
         email = :email,
         password = :password,
         name = :name';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->password = htmlspecialchars(strip_tags($this->password));
        
        // Hash password
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        
        // Bind data
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $this->hashedPassword);
        
        // Execute Query
        if ($stmt->execute()) {
            return $stmt;
        }
        
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        
        return false;
    }
    
    // Update User
    public function update($id) {
        // Create query
        $query = 'UPDATE ' . $this->table . '
         SET
         email = :email,
         password = :password,
         name = :name
         WHERE id = ' . $id;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
    
        // Clean data
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->password = htmlspecialchars(strip_tags($this->password));
    
        // Hash password
        $this->hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
    
        // Bind data
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':password', $this->hashedPassword);
        
        // Execute Query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        
        return false;
    }
    
    // Delete user
    public function delete(){
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        
        if($stmt->execute()){
            return true;
        }
        
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        
        return false;
    }
    
}