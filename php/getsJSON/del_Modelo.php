<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$valFamilia = $_REQUEST['familia'];
	$valModelo = $_REQUEST['modelo'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

	$q_modelos = "DELETE FROM modelos WHERE Modelo = '".$valModelo."' AND Familia = '".$valFamilia."'";
	
	if (mysqli_query($con, $q_modelos)) {

		$q_operaciones = "DELETE FROM operaciones WHERE Modelo = '".$valModelo."' AND Familia = '".$valFamilia."'";
		if (mysqli_query($con, $q_operaciones)) {
			$query_load = mysqli_query($con, "SELECT DISTINCT Modelo FROM modelos WHERE Familia = '".$valFamilia."' ORDER BY Modelo");
			$num_rows = mysqli_num_rows($query_load);
			if ($num_rows != 0) {
				while ($row = mysqli_fetch_assoc($query_load)) {
					$rows[] = $row;
				}
				print(json_encode($rows));
			} else {
				echo "<script>alert('No se encontraron modelos');</script>";
			}
		} else {
			echo "Error: " . $q_operaciones . "<br>" . mysqli_error($con);
		}

	} else {
		echo "Error: " . $q_modelos . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
}
?>