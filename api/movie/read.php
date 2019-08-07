<?php
// Headers (Accessible by anyone)
header('Access-Control-Allow-Origin: *');
// Type we want to accept
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Movie.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate a movie object
$movie = new Movie($db);

// Movies query
$result = $movie->read();

// Get row count
$num = $result->rowCount();

// Check if any movies
if ($num > 0) {
    // Movies array
    $movies_arr = array();
    
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        
        $movie_item = array(
            'id' => $id,
            'title' => $title,
            'genreId' => $genreId,
            'genreName' => $genreName,
            'numberInStock' => $numberInStock,
            'dailyRentalRate' => $dailyRentalRate,
            'publishDate' => $publishDate
        );
        
        // Push to array
        array_push($movies_arr, $movie_item);
    }
    // Turn to JSON and output
    echo json_encode($movies_arr);
} else {
    // No movies
    echo json_encode(
        array('message' => "No Movies Found.")
    );
}

