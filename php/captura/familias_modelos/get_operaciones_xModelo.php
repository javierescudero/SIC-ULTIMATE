<?php
require_once("conexion.php");

if ($_REQUEST['ajax']) {

	$modelo = $_REQUEST['modelo'];
	$area = $_REQUEST['area'];

	if ($area == "electronica") {
		$database = "electronica";
	} elseif ($area == "electromecanicos") {
		$database = "electromecanicos";
	} elseif ($area == "valvulas") {
		$database = "valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	$query = mysqli_query($con, "SELECT DISTINCT Operacion, Descripcion, UsarPPms, Grupo FROM operaciones WHERE Modelo = '".$modelo."' ORDER BY Operacion");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		while ($row = mysqli_fetch_assoc($query)) {
			$rows[] = $row;
		}
		print(json_encode($rows));
	} else {
		echo "<script>alert('Ningun Modelo');</script>";
	}
	mysqli_close($con);
}
?>