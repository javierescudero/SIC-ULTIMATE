<?php
require_once("conexion.php");

if ($_REQUEST['ajax']) {

	$valFamilia = $_REQUEST['familia'];
	$area = $_REQUEST['area'];

	if ($area == "electronica") {
		$database = "electronica";
	} elseif ($area == "electromecanicos") {
		$database = "electromecanicos";
	} elseif ($area == "valvulas") {
		$database = "valvulas";
	}

	$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
	
	$q = "DELETE FROM familias WHERE Familias = '".$valFamilia."'";
	
	if (mysqli_query($con, $q)) {
		$query_load = mysqli_query($con, "SELECT DISTINCT Familias FROM familias ORDER BY Familias");
		$num_rows = mysqli_num_rows($query_load);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query_load)) {
				$rows[] = $row;
			}
			print(json_encode($rows));
		} else {
			echo "<script>alert('No se encontraron familias');</script>";
		}
	} else {
		echo "Error: " . $q . "<br>" . mysqli_error($con);
	}
	mysqli_close($con);
}
?>