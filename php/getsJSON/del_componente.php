<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$modelo = $_REQUEST['modelo'];
	$componente = $_REQUEST['componente'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	
	$q_comp = "DELETE FROM componentes WHERE Comp = '".$componente."'";
	
	if (mysqli_query($con, $q_comp)) {
		$query_load = mysqli_query($con, "SELECT DISTINCT Comp FROM componentes WHERE Modelo = '".$modelo."' ORDER BY Comp");
		$num_rows = mysqli_num_rows($query_load);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_load)) {
				$rows[] = $row;
			}
			print(json_encode($rows));
		} else {
			echo "<script>alert('No se encontraron componentes');</script>";
		}
	} else {
		echo "Error: " . $q_comp . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
}
?>