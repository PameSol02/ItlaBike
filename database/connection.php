<?php
include("config/config.php");

class Connection {
	public $conn;
	
	function __construct() {
		$this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	}

	function __destruct(){
		mysqli_close($this->conn);
	}
}
?>