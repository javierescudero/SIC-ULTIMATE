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

		/*if ($codigo[1] == 'cod 555') {
			print(json_encode('exito'));
		} else {
			print(json_encode('error'));
		}*/

		

		if ($area == "Electronica") {
			$database = "Electronica";
		} elseif ($area == "Electromecanicos") {
			$database = "Electromecanicos";
		} elseif ($area == "Valvulas") {
			$database = "Valvulas";
		}

		$con = mysqli_connect(SERVER, USER, PASSWORD, $database);

		$respuesta = false;

		for ($i=0; $i < count($codigo); $i++) { 
			//print(json_encode('exito'));
			$q = "INSERT INTO datos (Fecha, Tno, Linea, Empleado, Modelo, Op, Cant, Cod, Comp, Prod, Familia, PieRech) VALUES ('".$fecha."', '".$turno."', '".$linea."', '".$empleado."', '".$modelo."', '".$operacion."', '".$cantidad[$i]."', '".$codigo[$i]."', '".$componente[$i]."', '".$produccion."', '".$familia."', '".$piezas."')";
			if (mysqli_query($con, $q)) {
				$respuesta = true;
			} else {
				$respuesta = false;
			}
		}

		if ($respuesta) {
			$rows[] = 'exito';
			print(json_encode($rows));

		} else {
			$rows[] = 'error';
			print(json_encode($rows));
		}

		

		mysqli_close($con_user);
	}
?>