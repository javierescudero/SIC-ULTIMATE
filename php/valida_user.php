<?php
	session_start();
	if (isset($_POST['$usuario'])) {
		$_SESSION['sesion_usuario'] = $_POST['$usuario'];
	} else {
		echo "<script>alert('USUARIO NO VALIDO');</script>";
	}
?>
<html>
<head>
	<title>Validando Usuario</title>
	<script src="js/jquery-1.12.4.min.js"></script>
</head>
<body>
	<?php
		$usuario = $_POST['user'];
		$password = $_POST['password'];

		if ($usuario == 'admin' && $password == '1234') {
			echo "<script type='text/javascript'>";
			echo 	"alert('Acceso Correcto');";
			echo 	"window.location.href='php/index.php';";
			echo "</script>";
		} else if ($usuario == '' || $password == '') {
			echo "<script type='text/javascript'>";
			echo 	"alert('Campos Vacios');";
			echo 	"window.location.href='index.html';"; // ../index.html en firefox
			echo "</script>";
		} else {
			echo "<script type='text/javascript'>";
			echo 	"alert('Datos Incorrectos');";
			echo 	"window.location.href='index.html';"; // ../index.html en firefox
			echo "</script>";
		}
	?>
</body>
</html>