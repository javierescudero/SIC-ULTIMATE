<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$valModelo = $_REQUEST['modelo'];
	$valCodigo = $_REQUEST['codigo'];
	$valregistrarComo = $_REQUEST['registrarAs'];
	$valDescripcion = $_REQUEST['descripcion'];
	$area = $_REQUEST['area'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	$query = mysqli_query($con, "SELECT * FROM codigos WHERE Codigo = '".$valCodigo."' AND Modelo = '".$valModelo."' ");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		$rows[] = 'existe';
		print(json_encode($rows));
	} else {

		$query_familia = mysqli_query($con, "SELECT Familia FROM modelos WHERE Modelo = '".$valModelo."'");

		$num_rows = mysqli_num_rows($query_familia);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_familia)) {
				$Familia = $row['Familia'];
			}

			$q = "INSERT INTO codigos (ID, Codigo, RegistrarAs, Descripcion, Modelo) VALUES (0, '".$valCodigo."', '".$valregistrarComo."', '".$valDescripcion."', '".$valModelo."')";
			if (mysqli_query($con, $q)) {
				$query_load = mysqli_query($con, "SELECT DISTINCT * FROM codigos WHERE Modelo = '".$valModelo."' ORDER BY Codigo");
				$num_rows = mysqli_num_rows($query_load);
				if ($num_rows != 0) {
					while ($row = mysqli_fetch_assoc($query_load)) {
						$rows[] = $row;
					}
					print(json_encode($rows));
				} else {
					$rows[] = 'noencontrado';
					print(json_encode($rows));
				}
			} else {
				$rows[] = 'error';
				print(json_encode($rows));
			}

		} else {
			$rows[] = 'noencontrada';
			print(json_encode($rows)); 
		}
	}
	mysqli_close($con);
}
?>