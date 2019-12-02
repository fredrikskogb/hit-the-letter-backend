<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once '../../configuration/Database.php';
  include_once '../../models/Highscore.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->getConnection();
  // Instantiate blog post object
  $highscore = new Highscore($db);
  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));
  // Set ID to update
  $highscore->user_id = $data->userId;
  $highscore->level = $data->level;
  $highscore->points = $data->points;
 
  // Update post
  if($highscore->updateHighscore()) {
    echo json_encode(
      array('message' => 'Highscore Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Highscore Not Updated')
    );
  }