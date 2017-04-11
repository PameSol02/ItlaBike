<?php
include("template.php");
include("database/userDB.php");
require_once('app/init.php');

plantilla::iniciarWithFBURL($fbauth->getAuthUrl());

if ($_POST) {

	if (isset($_POST['iEmailIniciar']) && isset($_POST['iPasswordIniciar'])) {
		$email = $_POST['iEmailIniciar'];
		$pass = $_POST['iPasswordIniciar'];

		$response = UserDB::login($email, $pass);
		if ($response == false) {
			echo "<script type=\"text/javascript\">alert('Datos incorrectos!')</script>";
		} else {
			$_SESSION['user_id'] = "$response->usuarioId";
			$_SESSION['user_name'] = "$response->nombre";
			$_SESSION['user_lastName'] = $response->apellido;
			$_SESSION['user_email'] = "$response->email";
			$_SESSION['user_image'] = "$response->foto";

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
	$_SESSION['user_name'] = $user->nombre;
	$_SESSION['user_lastName'] = $user->apellido;
	$_SESSION['user_email'] = $user->email;	
		//$_SESSION['user_image'] = $usuario['picture']['url'];

	echo "<script type=\"text/javascript\">
	var body = document.getElementById('body');
	body.innerHTML = \"\";
</script>";

plantilla::iniciar();
}
}

$ads = UserDB::getAllAd();
arsort($ads);
?>

<div class="container">
	<?php

	if (count($ads) == 0) {
		echo <<<html
		<div class="col-md-7 col-xs-7">
			
		</div>
html;
	} else {

		foreach ($ads as $ad) {
			echo <<<html
			<div class="col-md-7 col-xs-7 well ad">
				<div class="col-md-3 col-xs-3">
					<img src="$ad->foto" class="img-responsive" width="100" height="100">
				</div>
				<div class="col-md-6 col-xs-6">
					<a href="anuncioDetalle.php?id=$ad->anuncioId"><span class="link">$ad->titulo</span></a>
					<p class="description">
						$ad->descripcion
					</p>
				</div>
				<div class="col-md-3">
					<label><span class="glyphicon glyphicon-asterisk"></span>\$RD $ad->precio</label>
					<br>
					<br>
					<br>
					<h5>$ad->fecha</h5>
				</div>
			</div>
html;
	}
}
?>
<div class="col-md-4 col-md-offset-1">
	<img src="images/anuncio.jpg" class="img-responsive">
	<br>
	<img src="images/anuncio2.jpg" class="img-responsive">
</div>
</div>