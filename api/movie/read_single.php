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

// Get ID from URL
$movie->id = isset($_GET['id']) ? $_GET['id'] : die();

// Get post (Call the read_single)
$result = $movie->read_single($movie->id);
$row = $result->fetch(PDO::FETCH_ASSOC);

// See if the movie exists
$num = $result->rowCount();

if ($num > 0) {
    extract($row);
    
    // Create array
    $movie = array(
        'id' => $id,
        'title' => $title,
        'genreId' => $genreId,
        'genreName' => $genreName,
        'numberInStock' => $numberInStock,
        'dailyRentalRate' => $dailyRentalRate,
        'publishDate' => $publishDate
    );
    
    // Make JSON
    print_r(json_encode($movie));
} else {
    // No such movie
    echo json_encode(
        array('message' => 'There is no movie with that ID.')
    );
}