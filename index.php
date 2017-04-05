<?php
ob_start();
session_start();
include("template.php");
include("database/userDB.php");

plantilla::iniciar();

if ($_POST) {

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

?>

<div class="container">
	<div class="col-md-7 well ad">
		<div class="col-md-3">
			<img src="images/bicicleta.jpg" class="img-responsive">
		</div>
		<div class="col-md-6">
			<a href=""><span class="link">Link del anuncio</span></a>
			<p class="description">
				kjjklewjlefkjsdlkfdskjdfjfdkjkfdjkfdhfdjkdfjkfdsjkfdsjkdfsjksfdjkdfsjkdfsjkdfsjkdfskjdfsjkjfsdkjksdfjksfdjksfdkjsfdjksfdjksdfjkkjlsdfjkfddf
			</p>
		</div>
		<div class="col-md-3">
			<label><span class="glyphicon glyphicon-asterisk"></span>$RD 1000</label>
			<br>
			<br>
			<br>
			<h5>hace 3 horas</h5>
		</div>
	</div>
	<div class="col-md-4 col-md-offset-1">
		<img src="images/anuncio.jpg" class="img-responsive">
		<br>
		<img src="images/anuncio2.jpg" class="img-responsive">
	</div>
</div>

<script type="text/javascript">
	function login() {
		var email = document.getElementById('iEmailIniciar').value;
		var pass = document.getElementById('iPasswordIniciar').value;

		if (email != '' && pass != '') {
			//var valores = {email: email, pass: pass, isLogin: '1'};
			var valores = "email=" + email + "&pass=" + pass + "&isLogin=" + 1;
			var hr = new XMLHttpRequest();
			var url = "helper.php";

			hr.open("POST", url, true);
			hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			hr.onreadystatechange = function () {
				if (hr.readyState == 4 && hr.status == 200) {
					var data = hr.responseText;
					if (data == 1) {
						location.reload();
						$('#iniciarsesion').modal('hide');
					} else {
						alert("Datos incorrectos!");
					}
				}
			}
			hr.send(valores);
		} else {
			alert('Complete los datos para iniciar sesión.');
		}
	}
</script>