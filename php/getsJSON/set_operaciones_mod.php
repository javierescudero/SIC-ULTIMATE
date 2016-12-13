<?php
	session_start();
	require_once("../conexion.php");

	if ($_REQUEST['ajax']) {
		$modelo = $_REQUEST['modelo'];
		$operacion = $_REQUEST['operacion'];
		$descripcion = $_REQUEST['descripcion'];
		$usarppms = $_REQUEST['usarppms'];
		$grupo = $_REQUEST['grupo'];
		$area = $_REQUEST['area'];

		if ($usarppms == 'false') { $ppms = 0; } 
		else { $ppms= 1; }

		if ($area == "Electronica") {
			$database = "Electronica";
		} elseif ($area == "Electromecanicos") {
			$database = "Electromecanicos";
		} elseif ($area == "Valvulas") {
			$database = "Valvulas";
		}

		$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

		$query_update = " UPDATE operaciones SET Operacion = '".$operacion."', Descripcion = '".$descripcion."', UsarPPms = '".$ppms."', Grupo = '".$grupo."' WHERE Modelo = '".$modelo."' AND Operacion = '".$operacion."' ";

		if (mysqli_query($con, $query_update)) {

			$query_load = mysqli_query($con, "SELECT * FROM operaciones WHERE Modelo = '".$modelo."' ");
			$num_rows = mysqli_num_rows($query_load);

			if ($num_rows != 0) { 

				while ($row = mysqli_fetch_assoc($query_load)) { $rows[] = $row; }

				print(json_encode($rows));

			} else {

				$rows[] = 'default';
				print(json_encode($rows));

			}

		} else {

			$rows[] = 'error';
			print(json_encode($rows));

		}

		mysqli_close($con);
	}
?>