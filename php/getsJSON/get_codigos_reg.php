<?php
require_once("../conexion.php");
header('Content-Type: text/html; charset=utf-8');

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

	$query = mysqli_query($con, "SELECT DISTINCT Codigo FROM codigos WHERE Modelo = '".$modelo."' ORDER BY Codigo");
	//print_r($query);
	
	//$query = mysqli_query($con, "SELECT Codigo FROM codigos WHERE Modelo is NULL ORDER BY Codigo");
	//$query = mysqli_query($con, "SELECT * FROM codigos WHERE (Modelo is NULL OR Modelo = '' AND Modelo = '".$modelo."') ORDER BY Codigo");
	//$query = mysqli_query($con, "SELECT * FROM codigos WHERE Modelo is NULL AND Modelo = '".$modelo."' ORDER BY Codigo");
	//$query = mysqli_query($con, "SELECT Codigo FROM codigos WHERE Modelo = '".$modelo."' OR NULLIF (Modelo, '') is NULL ORDER BY Codigo");
	//$query = mysqli_query($con, "SELECT Codigo FROM codigos WHERE Modelo = '".$modelo."' AND (Modelo is NULL OR Modelo = '') ORDER BY Codigo");
	//$query = mysqli_query($con, "SELECT Codigo FROM codigos WHERE Modelo is NULL AND Modelo = '".$modelo."' ORDER BY Codigo");
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