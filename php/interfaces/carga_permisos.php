<?php
	session_start();
	require_once("../conexion.php");

	if ($_REQUEST['ajax']) {
		$usuario = strtolower($_REQUEST['usuario']);
		//$password = hash('md5', $_REQUEST['password']);

		$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."'");
		$num_rows = mysqli_num_rows($query);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$rows[] = $row;
			}
			print(json_encode($rows));
		} else {
			$rows[] = 'noencontrado';
			print(json_encode($rows));
		}
	}
?>