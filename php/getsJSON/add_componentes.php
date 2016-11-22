<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$componente = $_REQUEST['componente'];
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
	$query = mysqli_query($con, "SELECT * FROM componentes WHERE Comp = '".$componente."'");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		echo "<script>alert('Ya existe en la base de datos.\nPruebe con otro distinto.');</script>";
	} else {

		$q = "INSERT INTO componentes (Modelo, Comp) VALUES ('".$modelo."', '".$componente."')";
		if (mysqli_query($con, $q)) {
			
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
			echo "<script>alert('ERROR: Hubo un problema al insertar elemento.');</script>";
		}
	}
	mysqli_close($con);
}
?>