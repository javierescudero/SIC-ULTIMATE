<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$modelo = $_REQUEST['modelo'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	$query = mysqli_query($con, "SELECT DISTINCT * FROM codigos WHERE Modelo = '".$modelo."' ORDER BY Codigo LIMIT 16");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		while ($row = mysqli_fetch_assoc($query)) {
			$rows[] = $row;
		}
		print(json_encode($rows));
	} else {
		$rows[] = '';
		print(json_encode($rows));
	}
	mysqli_close($con);
}
?>