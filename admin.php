<?php
include("database/userDB.php");
require_once('app/init.php');

if ($_POST) {
	$user = $_POST['iUser'];
	$pass = $_POST['iPass'];

	$result = UserDB::adminLogin($user, $pass);
	$_SESSION['is_admin'] = "1";
	$_SESSION['admin_name'] = "$result->nombre";
	$_SESSION['admin_lastName'] = "$result->apellido";
	$_SESSION['admin_email'] = "$result->email";

	header("Location: index.php");

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link href="css/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>
<body>
	<h2 class="text-primary text-center">Admin control</h2>
	<h4 class="text-center">Login</h4>
	<div class="col-md-12">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<form class="form-horizontal" method="post" action="admin.php">
				<div class="form-group">
					<label for="iUser" class="col-lg-2 control-label">Email</label>
					<div class="col-lg-10">
						<input type="text" class="form-control" id="iUser" name="iUser" placeholder="Email" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
				<label for="iPass" class="col-lg-2 control-label">Contraseña</label>
					<div class="col-lg-10">
						<input type="password" class="form-control" id="iPass" name="iPass" placeholder="Contraseña" autocomplete="off">
					</div>
				</div>
				<div class="form-group">
					<div class="col-lg-10 col-lg-offset-2">
						<button type="reset" class="btn btn-default">Cancelar</button>
						<button type="submit" class="btn btn-primary">Login</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-md-3"></div>
	</div>

	<script src="css/js/bootstrap.min.js"></script>
	<script src="css/js/jquery.js"></script>
</body>
</html>