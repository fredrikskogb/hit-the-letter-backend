<?php
class Database{
 
    // specify your own database credentials
    private $database;
    public $conn;

    public function __construct(){
        $this->database = include('config.php');
    }

    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->database['host'] . ";dbname=" . $this->database['db_name'], $this->database['username'], $this->database['password']);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>