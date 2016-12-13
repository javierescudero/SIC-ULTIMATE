<?php
	session_start();
	require_once("../conexion.php");

	if ($_REQUEST['ajax']) {
		$modelo = $_REQUEST['modelo'];
		$codigo = $_REQUEST['codigo'];
		$registrarAs = $_REQUEST['registrarAs'];
		$descripcion = $_REQUEST['descripcion'];
		$area = $_REQUEST['area'];

		if ($area == "Electronica") {
			$database = "Electronica";
		} elseif ($area == "Electromecanicos") {
			$database = "Electromecanicos";
		} elseif ($area == "Valvulas") {
			$database = "Valvulas";
		}

		$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

		$query_update = " UPDATE codigos SET RegistrarAs = '".$registrarAs."', Descripcion = '".$descripcion."' WHERE Modelo = '".$modelo."' AND Codigo = '".$codigo."' ";

		if (mysqli_query($con, $query_update)) {

			$query_load = mysqli_query($con, "SELECT * FROM codigos WHERE Modelo = '".$modelo."' ");
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