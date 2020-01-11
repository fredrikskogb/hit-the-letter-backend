<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// include database and object files
include_once '../../configuration/Database.php';
include_once '../../models/User.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);

// set ID property of user to be edited
$user->username = $_GET["username"];

if(password_verify($_GET["password"], $user->getPassword())){
    $user->password = $user->getPassword();
}

// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "id" => $row['id'],
        "email" => $row['email'],
        "username" => $row["username"]
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid username or Password!",
    );
}
// make it json format
print_r(json_encode($user_arr));
?>