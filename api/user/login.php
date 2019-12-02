<?php
// include database and object files
include_once '../../configuration/Database.php';
include_once '../../models/User.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$user = new User($db);

$data = json_decode(file_get_contents("php://input"));

// set ID property of user to be edited
$user->email = $data->email;

if(password_verify($data->password, $user->getPassword())){
    $user->password = $user->getPassword();
}

// read the details of user to be edited
$stmt = $user->login();
if($stmt->rowCount() > 0){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $user_arr=array(
        "status" => true,
        "message" => "Successfully Login!",
        "id" => $row['id'],
        "email" => $row['email']
    );
}
else{
    $user_arr=array(
        "status" => false,
        "message" => "Invalid email or Password!",
    );
}
// make it json format
print_r(json_encode($user_arr));
?>