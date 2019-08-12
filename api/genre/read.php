<?php
// Headers (Accessible by anyone)
header('Access-Control-Allow-Origin: *');
// Type we want to accept
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Genre.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate a movie object
$genre = new Genre($db);

// Movies query
$result = $genre->read();

// Get row count
$num = $result->rowCount();

// Check if any genres
if ($num > 0) {
    // Movies genres
    $genre_arr = array();
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $genre_item = array(
            'id' => $id,
            'name' => $name,
        );
        
        // Push to array
        array_push($genre_arr, $genre_item);
    }
    // Turn to JSON and output
    echo json_encode($genre_arr);
} else {
    // No movies
    echo json_encode(
        array('message' => "No Genres Found.")
    );
}
