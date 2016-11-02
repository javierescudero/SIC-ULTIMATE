<?php
	define("SERVER", "127.0.0.1");
	define("USER", "root");
	define("PASSWORD", "root");

	define("DB_USERS", "users");
	define("DB_ELECTRONICA", "electronica");
	define("DB_ELECTROMECANICOS", "electromecanicos");
	define("DB_VALVULAS", "valvulas");

	$con_user = mysqli_connect(SERVER, USER, PASSWORD, DB_USERS);
	if (!$con_user) {
		die("Conexion a DB_USERS Fallida: " . mysqli_connect_error());
	}

	$con1 = mysqli_connect(SERVER, USER, PASSWORD, DB_ELECTRONICA);
	if (!$con1) {
		die("Conexion a DB_ELECTRONICA Fallida: " . mysqli_connect_error());
	}

	$con2 = mysqli_connect(SERVER, USER, PASSWORD, DB_ELECTROMECANICOS);
	if (!$con2) {
		die("Conexion a DB_ELECTROMECANICOS Fallida: " . mysqli_connect_error());
	}

	$con3 = mysqli_connect(SERVER, USER, PASSWORD, DB_VALVULAS);
	if (!$con3) {
		die("Conexion a DB_VALVULAS Fallida: " . mysqli_connect_error());
	}
?>