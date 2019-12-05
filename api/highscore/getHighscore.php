<?php
// include database and object files
include_once '../../configuration/Database.php';
include_once '../../models/Highscore.php';

// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare user object
$highscore = new Highscore($db);

// set ID property of user to be edited
$highscore->user_id = $_GET["userId"];

if($highscore->getHighscore()){
    // get retrieved row
    $row = $highscore->getHighscore()->fetch(PDO::FETCH_ASSOC);
    // create array
    $highscore_arr=array(
        "status" => true,
        "id" => $row["user_id"],
        "points" => $row["points"],
        "level" => $row["level"]
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