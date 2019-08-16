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

$user->name = $data->name;
$user->email = $data->username;
$user->password = $data->password;

// Check if the user already exists
$user_exists = $user->read_single();


if (!$user_exists) {
    
    // Create a User
    $result= $user->create();
    
    // Create token
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
    
    // Create array
    $user = array(
        'id' => $user->id,
        'email' => $user->email,
        'name' => $user->name,
        'jwt' => $jwt,
        'message' => 'User Created.'
    );
    
    
    // Make JSON
    print_r(json_encode($user));
   
}else {
    echo json_encode(
        array('message' => 'User already exists.')
    );
}

