<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$valModelo = $_REQUEST['modelo'];
	$valCodigo = $_REQUEST['codigo'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

	$query = "DELETE FROM codigos WHERE Codigo = '".$valCodigo."' AND Modelo = '".$valModelo."'";
	
	if (mysqli_query($con, $query)) {

		$query_load = mysqli_query($con, "SELECT DISTINCT * FROM codigos WHERE Modelo = '".$valModelo."' ORDER BY Codigo");
		$num_rows = mysqli_num_rows($query_load);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_load)) {
				$rows[] = $row;
			}
			print(json_encode($rows));
		} else {
			$rows[] = '';
			print(json_encode($rows));
		}
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
}
?>