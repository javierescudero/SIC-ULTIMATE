<?php
require_once("conexion.php");

if ($_REQUEST['ajax']) {

	$valFamilia = $_REQUEST['familia'];
	$valModelo = $_REQUEST['modelo'];
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
	$q_modelos = "DELETE FROM modelos WHERE Modelo = '".$valModelo."' AND Familia = '".$valFamilia."'";
	
	if (mysqli_query($con, $q_modelos)) {
		//$q_operaciones = "DELETE FROM operaciones WHERE Modelo = 'mod 001' AND Familia = '000'";
		$q_operaciones = "DELETE FROM operaciones WHERE Modelo = '".$valModelo."' AND Familia = '".$valFamilia."'";
		if (mysqli_query($con, $q_operaciones)) {
			echo "Se borraron todos los modelos correctamente.";
		} else {
			echo "Error: " . $q_operaciones . "<br>" . mysqli_error($con);
		}
		/*$query_load = mysqli_query($con, "SELECT DISTINCT Familias FROM familias ORDER BY Familias");
		$num_rows = mysqli_num_rows($query_load);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_load)) {
				$rows[] = $row;
			}
			print(json_encode($rows));
		} else {
			echo "<script>alert('No se encontraron familias');</script>";
		}*/
	} else {
		echo "Error: " . $q_modelos . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
}
?>