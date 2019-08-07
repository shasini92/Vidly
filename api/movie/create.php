<?php
// Headers (Accessible by anyone)
header('Access-Control-Allow-Origin: *');
// Type we want to accept
header('Content-Type: application/json');
// Which HTTP methods we want to allow
header('Access-Control-Allow-Methods: POST');
// Which Headers we want to allow
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Movie.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate a movie object
$movie = new Movie($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

$movie->title = $data->title;
$movie->genreId = $data->genreId;
$movie->numberInStock = $data->numberInStock;
$movie->dailyRentalRate = $data->dailyRentalRate;

// Create a Movie
if($movie->create()){
    echo json_encode(
        array('message' => 'Movie Created.')
    );
}else{
    echo json_encode(
        array('message' => 'Movie Not Created.')
    );
}