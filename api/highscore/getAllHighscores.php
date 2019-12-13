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


if($highscore->getAllHighscores()){
    // get retrieved row
    $row = $highscore->getAllHighscores()->fetchAll(PDO::FETCH_ASSOC);
    
}
else{
    $row=array(
        "status" => false,
        "message" => "Error",
    );
}
// make it json format
print_r(json_encode($row));
?>