<?php
	session_start();
	require_once('vendor/autoload.php');
	require_once('app/FacebookAuth.php');

	$facebook = new Facebook\Facebook([
		'app_id' => '883540168454196',
		'app_secret' => '0ac9dcd6ef4f33ff2461c20af55b0c63',
		'default_graph_version' => 'v2.6'
		]);

	$fbauth = new FacebookAuth($facebook);
?>