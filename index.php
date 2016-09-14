<?php
	session_start();
	include("conexion.php");
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>SIC Ultimate Login vw1.0</title>
	
	<script src="js/jquery-1.12.4.min.js"></script>
	<script src="js/jquery.mobile-1.4.5.js"></script>
	
	<link rel="stylesheet" href="css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="css/css_style.css">
</head>
<body>
<?php
if (isset($_POST['btnAceptar'])) {
	if (!empty($usuario) && !empty($password)) {	
		$usuario = $_POST['user'];
		$password = hash('md5', $_POST['password']);
		$query = mysqli_query($con, "SELECT * FROM permissions WHERE Usuario = '".$usuario."' AND Password = '".$password."'");
		$num_rows = mysqli_num_rows($query);

		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$dbusuario = $row['Usuario'];
				echo "Usuario: ".$dbusuario."<br>";
                $dbpassword = $row['Password'];
                echo "Password: ".$dbpassword."<br>";
                $dbcambpwd = $row['CambPwd'];
                $dbtipo = $row['tipo'];
                echo "Tipo de usuario: ".$dbtipo."<br>";
			}
			//echo "Salio del while.<br>";
			if ($usuario == $dbusuario && $dbpassword == $password) {
				echo "Entro a comparar usuario y password.<br>";
				switch ($dbtipo) {
					case 'administrador':
						$_SESSION['session_nombre_usuario'] = $dbusuario;
						header("Location: ../index.php");
						break;
				} //Fin del switch
			}
		} else {
			header('Location: ../index.html');
			//echo "<script>alert('Usuario o Password Incorrectos.'); window.location.href='../index.html';</script>"
			echo "Usuario o Password Incorrectos. ";
			
		}
	} else {
		echo "Campos vacios. ";
	}
} else {
	echo "Variable no valida";
}
?>
	<div data-role="page" data-theme="b" id="page">
		<div data-role="header" id="header">
			<center>
				<img src="public\images\Sicicon.ico">
			</center>
			<h1>SIC Ultimate<br> 
				<b>Login</b>
			</h1>
		</div>
		<form method="post" action="">
			<div data-role="content" id="content_login">
				<input type="text" id="user" name="user" placeholder="Usuario" required>
				<input type="password" id="password" name="password" placeholder="Password" required>
				<div data-role="fieldcontain" id="combo_area">
					<center><label for="selection_area"><b>Area</b></label></center>
					<select name="area" id="area">
						<option value="electronica">Electronica</option>
						<option value="electromecanicos">Electromecanicos</option>
						<option value="valvulas">Valvulas</option>
					</select>
				</div>
				<div id="divBtnsCampos">
					<center>
						<input type="submit" id="btnAceptar" name="btnAceptar" data-icon="check" data-inline="true" data-transition="pop" value="Aceptar">
						<input type="button" id="btnCancelar" data-role="button" onclick="window.close();" data-icon="delete" data-inline="true" value="Cancelar">
					</center>
				</div>
			</div>
		</form>
	</div>
</body>
</html>