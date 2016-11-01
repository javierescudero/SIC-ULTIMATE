<?php
	define("SERVER", "127.0.0.1");
	define("USER", "root");
	define("PASSWORD", "root");
	define("DB", "electronica");

	$con = mysqli_connect(SERVER, USER, PASSWORD, DB);

	if (!$con) {
		die("Conexion Fallida: " . mysqli_connect_error());
	}
?>