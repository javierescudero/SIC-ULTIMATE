<?php

	$area = $_POST['area'];

	//echo $area;

	if (!($conexion = mysql_connect("localhost", "root", "root"))) {
		echo "Sin conexion";
		exit();
	} else {
		if ($area == 'electronica') {
			mysql_select_db("Electronica", $conexion);
			echo "electronica";
		} else if ($area == 'electromecanicos') {
			mysql_select_db("ignitor", $conexion);
			echo "electromecanicos";
		} else if ($area == 'valvulas') {
			mysql_select_db("cpi", $conexion);
			echo "valvulas";
		} else {
			mysql_close($conexion);
		}
	}

?>