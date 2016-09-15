<?php
	session_start();
	require_once("php/conexion.php");
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
<?php
	if(isset($_POST['login'])) {
		$usuario = strtolower($_POST['user']);
		$password = hash('md5', $_POST['password']);
		
		if (!empty($usuario) && !empty($password)) {
			$query = mysqli_query($con, "SELECT * FROM permissions WHERE Usuario = '".$usuario."' AND Password = '".$password."'");
			$num_rows = mysqli_num_rows($query);

			if ($num_rows != 0) {
				echo "<script>alert('Entro a num_rows.');</script>";
				while ($row = mysqli_fetch_assoc($query)) {
					echo "<script>alert('Entro al while.');</script>";
					$dbusuario = strtolower($row['Usuario']);
	                $dbpassword = $row['Password'];
	                $dbcambpwd = $row['CambPwd'];
	                $dbtipo = $row['tipo'];
				}
				if ($usuario == $dbusuario && $dbpassword == $password) {
					echo "<script>alert('Entro a comparar user y password.');</script>";
					switch ($dbtipo) {
						case 'administrador':
							$_SESSION['session_nombre_usuario'] = $dbusuario;
							echo "<script>alert('Entro a usuario administrador.');</script>";
							echo "<script>window.location.href='permisos.php'</script>";
							break;
					} //Fin del switch
				}
			} else {
				//$mensaje = "Usuario o Password Incorrectos.";
				echo "<script>alert('Usuario o Password Incorrectos.');</script>";
			}
		} else {
			echo "<script>alert('Favor de llenar los campos.');</script>";
		}
	} else {
		echo "<script>alert('Variable submit NO funciono');</script>";
	}
?>
<body>

	<div data-role="page" data-theme="b" id="page">
		<div data-role="header" id="header">
			<center>
				<img src="public\images\Sicicon.ico">
			</center>
			<h1>SIC Ultimate<br> 
				<b>Login</b>
			</h1>
		</div>
		<form method="post" action="" data-ajax="false">
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
						<input type="submit" id="btnAceptar" name="login" data-icon="check" data-inline="true" data-transition="pop" value="Aceptar">
						<input type="button" id="btnCancelar" data-role="button" onclick="window.close();" data-icon="delete" data-inline="true" value="Cancelar">
					</center>
				</div>
			</div>
		</form>
	</div>
</body>
</html>
