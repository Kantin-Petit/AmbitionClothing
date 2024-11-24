<?php
	
	define('HOST', 'localhost');
	define('DB_NAME', 'ambition');
	define('USER', 'root');
	define('PASS', '');

	try {

		$db = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME .";charset=utf8", USER, PASS);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		echo $e;
	}