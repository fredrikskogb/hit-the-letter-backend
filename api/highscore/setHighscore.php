<?php
 
// get database connection
include_once '../../configuration/Database.php';
 
// instantiate user object
include_once '../../models/Highscore.php';
 
$database = new Database();
$db = $database->getConnection();
 
$highscore = new Highscore($db);
 
$data = json_decode(file_get_contents("php://input"));

// set user property values
$highscore->user_id = $data->userId;
$highscore->level = $data->level;
$highscore->points = $data->points;

// create the user
if($highscore->setHighscore()){
    $highscore_arr=array(
        "status" => true,
        "id" => $highscore->user_id,
        "score" => $highscore->score
    );
}
else{
    $highscore_arr=array(
        "status" => false,
        "message" => "Error"
    );
}
print_r(json_encode($highscore_arr));
?>