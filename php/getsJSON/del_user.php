<?php
	session_start();
	require_once("../conexion.php");

	if ($_REQUEST['ajax']) {
		$usuario = strtolower($_REQUEST['usuario']);
		$password = hash('md5', $_REQUEST['password']);

		$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."'");
		$num_rows = mysqli_num_rows($query);
		if ($num_rows != 0) {
			
			$query = "DELETE FROM permissions WHERE Usuario = '".$usuario."'";
			if (mysqli_query($con_user, $query)) {
				$rows[] = 'eliminado';
				print(json_encode($rows));
			} else {
				$rows[] = 'error';
				print(json_encode($rows));
			}
		} else {
			$rows[] = 'noencontrado';
			print(json_encode($rows));
		}
	}
?>