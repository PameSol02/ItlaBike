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

		return $con->insert_id;
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
			return $data[0];
		} else {
			return false;
		}
	}

	public static function validateIfEmailExists($email) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT * FROM usuario WHERE email = '{$email}';";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		if (count($data) > 0) {
			return $data[0];
		} else {
			return false;
		}
	}

	public static function insertFacebookData($email, $image, $firstName) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "INSERT INTO Usuario (nombre, email, foto, rolId) VALUES ('{$firstName}', '{$email}', '{$image}', 1)";

		mysqli_query($con, $sql);

		return $con->insert_id;
	}

	public static function getUserData($id) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT * FROM Usuario WHERE usuarioId = $id";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		return $data[0];
	}

	public static function updateUserData($user) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "UPDATE Usuario set nombre = '{$user->nombre}', apellido = '{$user->apellido}', foto = '{$user->foto}'";

		mysqli_query($con, $sql);

		return true;
	}

	public static function insertAd($anuncio) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "INSERT INTO Anuncio (categoria, titulo, descripcion, precio, marca, modelo, accionId, usuarioId) VALUES ('{$anuncio->categoria}', '{$anuncio->titulo}', '{$anuncio->descripcion}', '{$anuncio->precio}', '{$anuncio->marca}', '{$anuncio->modelo}', '{$anuncio->accion}', '{$anuncio->usuarioId}')";

		try {

			mysqli_query($con, $sql);

			$id = $con->insert_id;
			self::insertAdImage($anuncio->images, $id);

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public static function updateAd($anuncio) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "UPDATE Anuncio set categoria = '{$anuncio->categoria}', titulo = '{$anuncio->titulo}', descripcion = '{$anuncio->descripcion}', precio = '{$anuncio->precio}', marca = '{$anuncio->marca}', modelo = '{$anuncio->modelo}', accionId = '{$anuncio->accion}' WHERE anuncioId = {$anuncio->anuncioId};";

		try {

			mysqli_query($con, $sql);

			$id = $con->insert_id;
			self::insertAdImage($anuncio->images, $id);

			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public static function insertAdImage($images = array(), $anuncioId) {
		self::checkDBC();
		$con = self::$connection->conn;

		foreach ($images as $image) {
			$sql = "INSERT INTO anuncioImage (image, anuncioId) VALUES ('{$image}', '{$anuncioId}');";
			mysqli_query($con, $sql);
		}
	}

	public static function getAllAd() {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT anuncio.anuncioId, anuncio.titulo, anuncio.descripcion, anuncio.precio, anuncio.marca, anuncio.modelo, anuncio.accionId, anuncio.fecha, max(anuncioImage.image) as foto FROM anuncio inner join anuncioImage on (anuncio.anuncioId = anuncioImage.anuncioId) group by anuncio.anuncioId;";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		return $data;
	}

	public static function getAd($id) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT * FROM Anuncio WHERE anuncioId = $id";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		return $data[0];
	}

	public static function getUserAd($id) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT * FROM Anuncio WHERE usuarioId = $id";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		return $data;
	}

	public static function deleteAdd($id) {
		self::checkDBC();
		$con = self::$connection->conn;

		$deleteImage = "DELETE FROM anuncioImage WHERE anuncioId = $id;";
		$deleteAd = "DELETE FROM Anuncio WHERE anuncioId = $id;";


		try {
			mysqli_query($con, $deleteImage);
			mysqli_query($con, $deleteAd);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public static function deleteImageAd($id) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "DELETE FROM anuncioImage WHERE anuncioId = $id";
		mysqli_query($con, $sql);
	}

	public static function getAdImages($id) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT * FROM anuncioImage WHERE anuncioId = $id";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		return $data;
	}

	public static function insertAddress($address) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "INSERT INTO UsuarioDireccion (usuarioId, calle, numero, sector, ciudad, provincia, pais) VALUES ('{$address->usuarioId}', '{$address->calle}', '{$address->numero}', '{$address->sector}', '{$address->ciudad}', '{$address->provincia}', '{$address->pais}')";

		try {
			mysqli_query($con, $sql);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	public static function updateAddress($address) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "UPDATE UsuarioDireccion set calle = '{$address->calle}', numero = '{$address->numero}', sector = '{$address->sector}', '{$address->ciudad}', '{$address->provincia}', '{$address->pais}' WHERE usuarioId = {$address->usuarioId}";

		mysqli_query($con, $sql);

		return true;
	}

	public static function getAddress($id) {
		self::checkDBC();
		$con = self::$connection->conn;

		$sql = "SELECT * FROM UsuarioDireccion WHERE usuarioId = $id";

		$result = mysqli_query($con, $sql);

		$data = array();
		while ($row = mysqli_fetch_object($result)) {
			$data[] = $row;
		}

		if (count($data) > 0) {
			return $data;
		} else {
			return false;
		}
	}
}
?>