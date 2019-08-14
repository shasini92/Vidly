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
include_once '../../models/User.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate a user object
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

$user->email = $data->username;
$user->password = $data->password;

// Check the database for this user
$result = $user->read_single();
$row = $result->fetch(PDO::FETCH_ASSOC);
extract($row);

// Get row count
$num = $result->rowCount();

if ($num === 0) {
    echo json_encode(
        array('message' => "User doesn't exist.")
    );
    
} else {
    if(password_verify($user->password, $password)){
        // TODO Create JWT
        echo json_encode(
            array('message' => 'SUCCESS')
        );
    }else{
        echo json_encode(
            array('message' => 'WRONG PASSWORD')
        );
    }
}