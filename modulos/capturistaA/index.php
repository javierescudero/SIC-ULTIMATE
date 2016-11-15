<?php
	session_start();
	require_once("../../php/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>SIC Ultimate Admin vw1.0</title>
	
	<script src="../../js/jquery-1.12.4.min.js"></script>
	<script src="../../js/jquery.mobile-1.4.5.js"></script>
	
	<link rel="stylesheet" href="../../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../../css/css_style.css">
</head>
<body>
	<div data-role="page" data-theme="b" id="page">
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<center>
				<img src="../../public/images/Sicicon.ico">
			</center>
			<h1>Capturista A</h1>
		</div>
		<?php 
			include("../../php/menus/menu_capturistaA.php");
		?>
	</div>
</body>
</html>