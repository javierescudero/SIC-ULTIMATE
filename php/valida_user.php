<?php
	$usuario = $_POST['user'];
	$password = $_POST['password'];

	if ($usuario == 'admin' && $password == '1234') {
		echo "<script type='text/javascript'>";
		echo 	"alert('Acceso Correcto');";
		echo 	"window.location.href='php/index.php';";
		echo "</script>";
	} else if ($usuario == '' || $password == '') {
		echo "<script type='text/javascript'>";
		echo 	"alert('Campos Vacios');";
		echo 	"window.location.href='vacio.html';";
		echo "</script>";
	} else {
		echo "<script type='text/javascript'>";
		echo 	"alert('Datos Incorrectos');";
		echo 	"window.location.href='mal.html';";
		echo "</script>";
	}
?>