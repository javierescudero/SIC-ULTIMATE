<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>SIC Ultimate</title>

	<script src="../js/jquery-1.12.4.min.js"></script>
	<script src="../js/jquery.mobile-1.4.5.js"></script>
	<script src="../js/js_refresh.js"></script>
	
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../css/css_style.css">
</head>
<body>
	<?php
		include("conexion.php");
		$usuario = $_POST['user'];
		$password = $_POST['password'];
		$area = $_POST['area'];

		if ($area == "ELECTRONICA") {
			$con = mysqli_connect(SERVER, USER, PASSWORD, DB) or die ("Error de conexion a la base de datos ELECTRONICA" . mysqli_error());
		} else {
			echo "PROBANDO CONEXIONES BASE DE DATOS";
		}
	?>
	<div data-role="page" data-theme="b">
		<?php
			include("menu.php");
		?>
	</div>
</body>
</html>