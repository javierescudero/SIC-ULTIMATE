<?php
	session_start();
	require_once("../conexion.php");

	if ($_REQUEST['ajax']) {
		$fecha = $_REQUEST['fecha'];
		$turno = $_REQUEST['turno'];
		$linea = $_REQUEST['linea'];
		$familia = $_REQUEST['familia'];
		$modelo = $_REQUEST['modelo'];
		$operacion = $_REQUEST['operacion'];
		$empleado = $_REQUEST['empleado'];
		$produccion = $_REQUEST['produccion'];
		$piezas = $_REQUEST['piezas'];
		$codigo = $_REQUEST['codigo'];
		$componente = $_REQUEST['componente'];
		$cantidad = $_REQUEST['cantidad'];
		$area = $_REQUEST['area'];

		if ($area == "Electronica") {
			$database = "Electronica";
		} elseif ($area == "Electromecanicos") {
			$database = "Electromecanicos";
		} elseif ($area == "Valvulas") {
			$database = "Valvulas";
		}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

	$q = "INSERT INTO datos (Fecha, Tno, Linea, Empleado, Modelo, Op, Cant, Cod, Comp, Prod, Familia, PieRech) VALUES ('".$fecha."', '".$turno."', '".$linea."', '".$empleado."', '".$modelo."', '".$operacion."', '".$cantidad."', '".$codigo."', '".$componente."', '".$produccion."', '".$familia."', '".$piezas."')";
	if (mysqli_query($con, $q)) {
		$rows[] = 'exito';
		print(json_encode($rows));

	} else {
		$rows[] = 'error';
		print(json_encode($rows));
	}

	mysqli_close($con_user);
	}
?>