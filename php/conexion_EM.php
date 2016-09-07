<?php
	define("SERVER", "127.0.0.1");
	define("USER", "root");
	define("PASSWORD", "root");
	define("DB_EM", "cpi");

	$con_EM = mysqli_connect(SERVER, USER, PASSWORD, DB_EM);

	if (!$con_EM) {
		die("Conexion Fallida: " . mysqli_connect_error());
	}
	echo "Conexion Exitosa";
?>