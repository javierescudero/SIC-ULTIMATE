<?php
require_once("../conexion.php");

if ($_REQUEST['ajax']) {

	$valFamilia = $_REQUEST['familia'];
	$valComponente = $_REQUEST['componente'];
	$valCantidad = $_REQUEST['cantidad'];

	if ($area == "Electronica") {
		$database = "Electronica";
	} elseif ($area == "Electromecanicos") {
		$database = "Electromecanicos";
	} elseif ($area == "Valvulas") {
		$database = "Valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	$query = mysqli_query($con, "SELECT * FROM operaciones WHERE Operacion = '".$valOperacion."' AND Modelo = '".$valModelo."'");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		echo "<script>alert('OPERACION Ya existe en la base de datos para este modelo.\nPruebe con otra distinta.');</script>";
	} else {

		if ($valPPms == 'true') {
			$usarPPms = 1;
		} else {
			$usarPPms = 0;
		}

		$query_familia = mysqli_query($con, "SELECT Familia FROM modelos WHERE Modelo = '".$valModelo."'");

		$num_rows = mysqli_num_rows($query_familia);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_familia)) {
				$familia = $row['Familia'];
			}

			$q = "INSERT INTO operaciones (ID, Modelo, Descripcion, Familia, Operacion, UsarPPms, Grupo) VALUES (0, '".$valModelo."', '".$valDescripcion."', '".$familia."', '".$valOperacion."', '".$usarPPms."', '".$valGrupo."')";
			if (mysqli_query($con, $q)) {
				$query_load = mysqli_query($con, "SELECT DISTINCT Operacion, Descripcion, UsarPPms, Grupo FROM operaciones WHERE Modelo = '".$valModelo."' ORDER BY Operacion");
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

		} else {
			echo "<script>alert('No se encontraron FAMILIAS');</script>";
		}
	}
	mysqli_close($con);
}
?>