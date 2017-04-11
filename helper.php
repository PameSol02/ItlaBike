<?php
include("database/userDB.php");

if ($_POST) {

	if (isset($_POST['iEmailIniciar']) && isset($_POST['iPasswordIniciar'])) {
		$email = $_POST['iEmailIniciar'];
		$pass = $_POST['iPasswordIniciar'];

		$response = UserDB::login($email, $pass);
		if ($response == false) {
			echo "<script type=\"text/javascript\">alert('Datos incorrectos!')</script>";
		} else {
			$_SESSION['user_id'] = "$response->usuarioId";
			$_SESSION['user_name'] = "$response->nombre" . "$response->apellido";
			$_SESSION['user_email'] = "$response->email";

			echo "<script type=\"text/javascript\">
			var body = document.getElementById('body');
			body.innerHTML = \"\";
			</script>";

			plantilla::iniciar();
		}
	} else {
		$user = new stdClass();
		$user->nombre = $_POST['iNombre'];
		$user->apellido = $_POST['iApellido'];
		$user->email = $_POST['iEmail'];
		$user->password = $_POST['iPassword'];
				//$user->foto = $_POST['iFoto'];
		$user->rolId = 1;

		$rs = UserDB::insert($user);
		$_SESSION['user_id'] = $rs;
		$_SESSION['user_name'] = $user->nombre . $user->apellido;
		$_SESSION['user_email'] = $user->email;	
		//$_SESSION['user_image'] = $usuario['picture']['url'];

		echo "<script type=\"text/javascript\">
		var body = document.getElementById('body');
		body.innerHTML = \"\";
		</script>";

		plantilla::iniciar();
	}
}

header('Location: index.php');

?>