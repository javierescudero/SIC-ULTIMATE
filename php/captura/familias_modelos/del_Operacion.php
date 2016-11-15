<?php
require_once("../../conexion.php");

if ($_REQUEST['ajax']) {

	$valModelo = $_REQUEST['modelo'];
	$valOperacion = $_REQUEST['operacion'];
	$area = $_REQUEST['area'];

	if ($area == "electronica") {
		$database = "electronica";
	} elseif ($area == "electromecanicos") {
		$database = "electromecanicos";
	} elseif ($area == "valvulas") {
		$database = "valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

	//$q_modelos = "DELETE FROM modelos WHERE Modelo = 'mod 001' AND Familia = '000'";
	//$query = "DELETE FROM operaciones WHERE Modelo = 'mod 002' AND Operacion = 'op aaaa'";
	$query = "DELETE FROM operaciones WHERE Modelo = '".$valModelo."' AND Operacion = '".$valOperacion."'";
	
	if (mysqli_query($con, $query)) {

		$query_load = mysqli_query($con, "SELECT DISTINCT Operacion, Descripcion, UsarPPms, Grupo FROM operaciones WHERE Modelo = '".$valModelo."' ORDER BY Operacion");
		$num_rows = mysqli_num_rows($query_load);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_load)) {
				$rows[] = $row;
			}
			print(json_encode($rows));
		} else {
			echo "<script>alert('No se encontraron familias');</script>";
		}
	} else {
		echo "Error: " . $query . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
}
?>