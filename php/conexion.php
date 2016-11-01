<?php
	define("SERVER", "127.0.0.1");
	define("USER", "root");
	define("PASSWORD", "root");
	define("DB", "electronica");

	$con_user = mysqli_connect(SERVER, USER, PASSWORD, DB);

	if (!$con_user) {
		die("Conexion a DB_ELECTRONICA Fallida: " . mysqli_connect_error());
	}
?>