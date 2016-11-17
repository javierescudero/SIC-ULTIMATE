<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$mod_origen = $_REQUEST['origen'];
	$mod_destino = $_REQUEST['destino'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

	$q = "INSERT INTO operaciones (SELECT 0,'".$mod_destino."', Descripcion, Familia, Operacion, UsarPPms, Grupo FROM operaciones WHERE Modelo = '".$mod_origen."')";
	if (mysqli_query($con, $q)) {
		$query_load = mysqli_query($con, "SELECT DISTINCT Operacion, Descripcion, UsarPPms, Grupo FROM operaciones WHERE Modelo = '".$mod_destino."' ORDER BY Operacion");
		$num_rows = mysqli_num_rows($query_load);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_load)) {
				$rows[] = $row;
			}
			print(json_encode($rows));
		} else {
			echo "<script>alert('No se encontraron MODELOS');</script>";
		}
	} else {
		echo "Error: " . $q . "<br>" . mysqli_error($con);
		echo "<script>alert('ERROR: Hubo un problema al insertar elemento.');</script>";
	}

	mysqli_close($con);
}
?>