<?php
	define("SERVER", "127.0.0.1");
	define("USER", "root");
	define("PASSWORD", "root");
	define("DB1", "electronica");
	define("DB2", "cpi");
	define("DB3", "ignitor");

	$conDefault = mysqli_connect(SERVER, USER, PASSWORD, DB1);

	if (isset($_POST['btnElectronica'])) {
		echo "<script>alert('Conectando a DB Electronica');</script>";
		$con = mysqli_connect(SERVER, USER, PASSWORD, DB1);
		echo "<script>window.location.href='index.php'</script>";
	} elseif (isset($_POST['btnElectromecanicos'])) {
		echo "<script>alert('Conectando a DB Electronmecanicos');</script>";
		$con = mysqli_connect(SERVER, USER, PASSWORD, DB2);
		echo "<script>window.location.href='index.php'</script>";
	} elseif (isset($_POST['btnValvulas'])) {
		echo "<script>alert('Conectando a DB Valvulas');</script>";
		$con = mysqli_connect(SERVER, USER, PASSWORD, DB3);
		echo "<script>window.location.href='index.php'</script>";
	} else {
		echo "<script>alert('Boton Invalido :(');</script>";
	}
?>