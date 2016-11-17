<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$valFamilia = $_REQUEST['familia'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	
	$q_familias = "DELETE FROM familias WHERE Familias = '".$valFamilia."'";
	
	if (mysqli_query($con, $q_familias)) {
		$q_modelos = "DELETE FROM modelos WHERE Familia = '".$valFamilia."'";
		if (mysqli_query($con, $q_modelos)) {
			$q_operaciones = "DELETE FROM operaciones WHERE Familia = '".$valFamilia."'";
			if (mysqli_query($con, $q_operaciones)) {
				echo "Se borraron todos los datos correctamente.";
				/*$query_load = mysqli_query($con, "SELECT DISTINCT Familias FROM familias ORDER BY Familias");
				$num_rows = mysqli_num_rows($query_load);
				if ($num_rows != 0) {
					while ($row = mysqli_fetch_assoc($query_load)) {
						$rows[] = $row;
					}
				} else {
					echo "<script>alert('No se encontraron familias');</script>";
				}*/
			} else {
				echo "Error: " . $q_operaciones . "<br>" . mysqli_error($con);
			}
		} else {
			echo "Error: " . $q_modelos . "<br>" . mysqli_error($con);
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
		echo "Error: " . $q_familias . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
}
?>