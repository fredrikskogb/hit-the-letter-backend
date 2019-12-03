<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
// include database and object files
include_once '../../configuration/Database.php';
include_once '../../models/Highscore.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$highscore = new Highscore($db);

$data = json_decode(file_get_contents("php://input"));

// set ID property of user to be edited
$highscore->user_id = $data->userId;
$highscore->level = $data->level;
$highscore->points = $data->points;

if($highscore->getHighscore()){
    // get retrieved row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    // create array
    $highscore_arr=array(
        "status" => true,
        "id" => $row['user_id'],
        "email" => $row['points']
    );
}
else{
    $highscore_arr=array(
        "status" => false,
        "message" => "Error",
    );
}
// make it json format
print_r(json_encode($highscore_arr));
?>