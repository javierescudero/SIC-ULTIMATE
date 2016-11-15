<?php
require_once("../../conexion.php");

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
	$query = mysqli_query($con, "SELECT * FROM modelos WHERE Modelo = '".$valModelo."'");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		echo "<script>alert('MODELO Ya existe en la base de datos.\nPruebe con otra distinta.');</script>";
	} else {

		$q = "INSERT INTO modelos (Modelo, Familia) VALUES ('".$valModelo."', '".$valFamilia."')";
		if (mysqli_query($con, $q)) {
			//echo "<script>alert('Se agrego MODELO correctamente.');</script>";
			
			$query_load = mysqli_query($con, "SELECT DISTINCT Modelo FROM modelos WHERE Familia = '".$valFamilia."' ORDER BY Modelo");
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
	}
	mysqli_close($con);
}
?>