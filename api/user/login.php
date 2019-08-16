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
// JWT Files
include_once '../../vendor/firebase/php-jwt/src/BeforeValidException.php';
include_once '../../vendor/firebase/php-jwt/src/ExpiredException.php';
include_once '../../vendor/firebase/php-jwt/src/SignatureInvalidException.php';
include_once '../../vendor/firebase/php-jwt/src/JWT.php';
include_once '../../config/core.php';
use \Firebase\JWT\JWT;

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate a user object
$user = new User($db);

// Get raw posted data
$data = json_decode(file_get_contents('php://input'));

$user->email = $data->username;

// Check the database for this user
$user_exists = $user->read_single();


if (!$user_exists) {
    echo json_encode(
        array('message' => "User doesn't exist.")
    );
    
} else {
    if (password_verify($data->password, $user->password)) {
        $token = array(
            "iss" => $iss,
            "aud" => $aud,
            "iat" => $iat,
            "nbf" => $nbf,
            "data" => array(
                "id" => $user->id,
                "name" => $user->name,
                "email" => $user->email
            )
        );
        
        // generate jwt
        $jwt = JWT::encode($token, $key);
        echo json_encode(
            array(
                "message" => "Successful login.",
                "jwt" => $jwt
            )
        );
        
    } else {
        // login failed
        
        // tell the user login failed
        echo json_encode(array("message" => "Invalid password."));
    }
}