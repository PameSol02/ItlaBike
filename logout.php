<?php
	require_once('app/init.php');

	$fbauth->signOut();

	header('Location: index.php');
?>