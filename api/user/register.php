<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// get database connection
include_once '../../configuration/Database.php';
 
// instantiate user object
include_once '../../models/User.php';
 
$database = new Database();
$db = $database->getConnection();
 
$user = new User($db);
 
$data = json_decode(file_get_contents("php://input"));

// set user property values
$user->email = $data->email;
$user->username = $data->username;
$user->password = password_hash($data->password, PASSWORD_DEFAULT);
$user->created = date('Y-m-d H:i:s'); 

// create the user
if($user->signup()){
    $user_arr=array(
        "id" => $user->id,
        "email" => $user->email,
        "username" => $user->username
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Email already exists!"
    );
}
print_r(json_encode($user_arr));
?>