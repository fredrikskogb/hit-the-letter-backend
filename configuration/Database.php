<?php 
	class Database {
    
	private $host = 'localhost';
	private $username = 'root';
	private $dbName = 'hit_the_letter';
	private $password = 'root';
	private $connection;
	// DB Connect
	public function connect() {
		$this->connection = null;
		try { 
			$this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbName, $this->username, $this->password);
			$this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'Connection Error: ' . $e->getMessage();
		}
		return $this->connection;
	}	
}