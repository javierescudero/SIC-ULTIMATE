<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$valFamilia = $_REQUEST['familia'];
	$valModelo = $_REQUEST['modelo'];
	$valOperacion = $_REQUEST['operacion'];
	$valDescripcion = $_REQUEST['descripcion'];
	$valPPms = $_REQUEST['ppms'];
	$valGrupo = $_REQUEST['grupo'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

	$query = mysqli_query($con, "SELECT * FROM operaciones WHERE Operacion = '".$valOperacion."' AND Familia = '".$valFamilia."' AND Modelo = '".$valModelo."'");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		echo "<script>alert('OPERACION Ya existe en la base de datos para este modelo.\nPruebe con otra distinta.');</script>";
	} else {

		if ($valPPms == 'true') {
			$usarPPms = 1;
		} else {
			$usarPPms = 0;
		}

		$q = "INSERT INTO operaciones (Modelo, Descripcion, Familia, Operacion, UsarPPms, Grupo) VALUES ('".$valModelo."', '".$valDescripcion."', '".$valFamilia."', '".$valOperacion."', '".$usarPPms."', '".$valGrupo."')";
		if (mysqli_query($con, $q)) {
			
			$query_load = mysqli_query($con, "SELECT DISTINCT Operacion, Descripcion, UsarPPms, Grupo FROM operaciones WHERE Modelo = '".$valModelo."' ORDER BY Operacion");
			$num_rows = mysqli_num_rows($query_load);
			if ($num_rows != 0) {
				while ($row = mysqli_fetch_assoc($query_load)) {
					$rows[] = $row;
				}
				print(json_encode($rows));
			} else {
				$rows[] = 'default';
				print(json_encode($rows));
			}
		} else {
			echo "Error: " . $q . "<br>" . mysqli_error($con);
			echo "<script>alert('ERROR: Hubo un problema al insertar elemento.');</script>";
		}
	}

	mysqli_close($con);
}
?>