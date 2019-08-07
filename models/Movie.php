<?php

class Movie {
    // DB Stuff
    private $conn;
    private $table = 'movies';
    
    // Properties
    public $id;
    public $title;
    public $genreId;
    public $genreName;
    public $numberInStock;
    public $dailyRentalRate;
    public $publishDate;
    
    // Constructor with DB
    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {
        // Create a query
        $query = 'SELECT m.*, g.name as genreName
                    FROM ' . $this->table . ' m
                    LEFT JOIN genres g
                    ON m.genreId = g.id
                    ORDER BY m.publishDate DESC';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        //Execute
        $stmt->execute();
        
        return $stmt;
    }
    
    public function read_single($id) {
        // Create a query
        $query = 'SELECT m.*, g.name as genreName
                    FROM ' . $this->table . ' m
                    LEFT JOIN genres g
                    ON m.genreId = g.id
                    WHERE m.id=' . $id;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        //Execute
        $stmt->execute();
        
        return $stmt;
    }
    
    // Create a Movie
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . '
         SET
         title = :title,
         genreId = :genreId,
         numberInStock = :numberInStock,
         dailyRentalRate = :dailyRentalRate';
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->genreId = htmlspecialchars(strip_tags($this->genreId));
        $this->numberInStock = htmlspecialchars(strip_tags($this->numberInStock));
        $this->dailyRentalRate = htmlspecialchars(strip_tags($this->dailyRentalRate));
        
        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':genreId', $this->genreId);
        $stmt->bindParam(':numberInStock', $this->numberInStock);
        $stmt->bindParam(':dailyRentalRate', $this->dailyRentalRate);
        
        // Execute Query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        
        return false;
    }
    
    // Update Post
    public function update($id) {
        // Create query
        $query = 'UPDATE ' . $this->table . '
         SET
         title = :title,
         genreId = :genreId,
         numberInStock = :numberInStock,
         dailyRentalRate = :dailyRentalRate
         WHERE id = ' . $id;
        
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        
        // Clean data
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->genreId = htmlspecialchars(strip_tags($this->genreId));
        $this->numberInStock = htmlspecialchars(strip_tags($this->numberInStock));
        $this->dailyRentalRate = htmlspecialchars(strip_tags($this->dailyRentalRate));
        
        // Bind data
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':genreId', $this->genreId);
        $stmt->bindParam(':numberInStock', $this->numberInStock);
        $stmt->bindParam(':dailyRentalRate', $this->dailyRentalRate);
        
        // Execute Query
        if ($stmt->execute()) {
            return true;
        }
        
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        
        return false;
    }
    
    // Delete movie
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