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
	$query = mysqli_query($con, "SELECT * FROM codigos WHERE Codigo = '".$valCodigo."'");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		echo "<script>alert('CODIGO Ya existe en la base de datos.\nPruebe con otro distinto.');</script>";
	} else {

		$query_familia = mysqli_query($con, "SELECT Familia FROM modelos WHERE Modelo = '".$valModelo."'");

		$num_rows = mysqli_num_rows($query_familia);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_familia)) {
				$familia = $row['Familia'];
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
					echo "<script>alert('No se encontraron MODELOS');</script>";
				}
			} else {
				echo "Error: " . $q . "<br>" . mysqli_error($con);
				echo "<script>alert('ERROR: Hubo un problema al insertar codigo.');</script>";
			}

		} else {
			echo "<script>alert('No se encontraron FAMILIAS');</script>";
		}
	}
	mysqli_close($con);
}
?>