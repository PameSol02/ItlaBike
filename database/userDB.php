<?php
include("database/connection.php");
class UserDB {
	
	public static $connection = null;

	public static function checkDBC(){
		if (self::$connection == null) {
			self::$connection = new connection();
		}
	}

	public static function insert($user) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "INSERT INTO Usuario (nombre, apellido, email, password, rolId) VALUES ('{$user->nombre}', '{$user->apellido}', '{$user->email}', '{$user->password}', 1)";

		mysqli_query($con, $sql);
	}

	public static function login($email, $pass) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT * FROM usuario WHERE email = '{$email}' and password = '{$pass}';";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		if (count($data) == 1) {
			return $data;
		} else {
			return false;
		}
	}
}
?>