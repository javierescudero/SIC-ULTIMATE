<?php
	define("SERVER", "127.0.0.1");
	define("USER", "root");
	define("PASSWORD", "root");
	define("DB_V", "ignitor");

	$con_V = mysqli_connect(SERVER, USER, PASSWORD, DB_V);

	if (!$con_V) {
		die("Conexion Fallida: " . mysqli_connect_error());
	}
	echo "Conexion Exitosa";
?>