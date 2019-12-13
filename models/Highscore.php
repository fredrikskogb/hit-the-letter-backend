<?php
class Highscore{
 
    // database connection and table name
    private $conn;
    private $table_name = "highscore";
 
    // object properties
    public $id;
    public $user_id;
    public $level;
    public $points;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function setHighscore(){
      
      // query to insert record
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
                  user_id=:user_id, level=:level, points=:points";
  
      // prepare query
      $stmt = $this->conn->prepare($query);
  
      // sanitize
      $this->user_id=htmlspecialchars(strip_tags($this->user_id));
      $this->level=htmlspecialchars(strip_tags($this->level));
      $this->points=htmlspecialchars(strip_tags($this->points));
  
      // bind values
      $stmt->bindParam(":user_id", $this->user_id);
      $stmt->bindParam(":level", $this->level);
      $stmt->bindParam(":points", $this->points);
  
      // execute query
      if($stmt->execute()){
        return true;
      }
  
      return false;
      
    }

    // login user
    function getHighscore(){

      // select all query
      $query = "SELECT
                  *
              FROM
                  " . $this->table_name . " 
              WHERE
                  user_id='".$this->user_id."'";
      // prepare query statement
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute();
      
      return $stmt;

    }

    function getAllHighscores(){

      // select all query
      $query = "SELECT
                  highscore.points, highscore.level, users.username
              FROM
                  " . $this->table_name . "
              JOIN
              users ON highscore.user_id=users.id
              ORDER BY
              highscore.points DESC";
      // prepare query statement
      $stmt = $this->conn->prepare($query);
      // execute query
      $stmt->execute();
      
      return $stmt;

    }

    public function updateHighscore() {
      // Create query
      $query = 'UPDATE ' . $this->table_name . '
                            SET user_id = :user_id, level = :level, points = :points
                            WHERE user_id = :user_id';
      // Prepare statement
      $stmt = $this->conn->prepare($query);
      // Clean data
      $this->user_id = htmlspecialchars(strip_tags($this->user_id));
      $this->level = htmlspecialchars(strip_tags($this->level));
      $this->points = htmlspecialchars(strip_tags($this->points));
      
      // bind values
      $stmt->bindParam(":user_id", $this->user_id);
      $stmt->bindParam(":level", $this->level);
      $stmt->bindParam(":points", $this->points);
  
      // Execute query
      if($stmt->execute()) {
        return true;
      }
      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);
      return false;
}

}