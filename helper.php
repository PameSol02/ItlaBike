<?php
include("database/userDB.php");

if ($_POST) {
	if (array_key_exists('isLogin', $_POST)) {
		if ($_POST['isLogin'] == '1') {
			$email = $_POST['email'];
			$pass = $_POST['pass'];

			$response = UserDB::login($email, $pass);

			if ($response == false) {
				echo 0;
			} else {
				$response = $response[0];
				$_SESSION['usuarioId'] = "$response->usuarioId";
				$_SESSION['usuarioNombre'] = "$response->nombre";
				$_SESSION['usuarioApellido'] = "$response->apellido";
				$_SESSION['usuarioEmail'] = "$response->email";

				echo 1;
			}

		} else {
			$user = new stdClass();
			$user->nombre = $_POST['iNombre'];
			$user->apellido = $_POST['iApellido'];
			$user->email = $_POST['iEmail'];
			$user->password = $_POST['iPassword'];
			//$user->foto = $_POST['iFoto'];
			$user->rolId = 1;

			UserDB::insert($user);
			var_dump($_POST);
		}
	}
}

?>