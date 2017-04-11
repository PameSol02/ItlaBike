<?php
	require_once('app/init.php');

	if($fbauth->login()) {
		header('location: index.php');
	} else {
		die('Error al iniciar sesion');
	}
?>