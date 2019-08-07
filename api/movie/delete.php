<?php
// Headers (Accessible by anyone)
header('Access-Control-Allow-Origin: *');
// Type we want to accept
header('Content-Type: application/json');
// Which HTTP methods we want to allow
header('Access-Control-Allow-Methods: DELETE');
// Which Headers we want to allow
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Movie.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate a movie object
$movie = new Movie($db);

// Get movie ID
$movie->id = isset($_GET['id']) ? $_GET['id'] : die();

// Delete post
if($movie->delete()){
    echo json_encode(
        array('message' => 'Movie Deleted.')
    );
}else{
    echo json_encode(
        array('message' => 'Movie Not Deleted.')
    );
}