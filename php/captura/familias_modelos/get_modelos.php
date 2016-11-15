<?php
require_once("conexion.php");

if ($_REQUEST['ajax']) {

	$familia = $_REQUEST['familia'];
	$area = $_REQUEST['area'];

	if ($area == "electronica") {
		$database = "electronica";
	} elseif ($area == "electromecanicos") {
		$database = "electromecanicos";
	} elseif ($area == "valvulas") {
		$database = "valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	$query = mysqli_query($con, "SELECT DISTINCT Modelo FROM modelos WHERE Familia = '".$familia."' ORDER BY Modelo");
	$num_rows = mysqli_num_rows($query);

	if ($num_rows != 0) {
		while ($row = mysqli_fetch_assoc($query)) {
			$rows[] = $row;
		}
		print(json_encode($rows));
	} else {
		echo "<script>alert('Ningun Modelo');</script>";
	}
	mysqli_close($con);
}
?>