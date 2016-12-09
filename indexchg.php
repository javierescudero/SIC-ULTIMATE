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
	<script type="text/javascript">
		$(document).ready(function(){
			$('#user').focus();

			$('#btnLimpiar').click(function() {
				$('#user').val('');
				$('#password').val('');
				$('#new_password').val('');
				$('#confirm_password').val('');
			});

			$('#btnCambiar').click(function() {
				var password = $('#password').val();
				var new_password = $('#new_password').val();
				var confirm_password = $('#confirm_password').val();

				if (password == new_password) {
					alert('Debes ingresar un password diferente');
					return false;
				}

				if (new_password != confirm_password) {
					alert('No coincide el nuevo pasword con la confirmacion');
					return false;
				}
			});

		});
	</script>
</head>
<?php
	if(isset($_POST['change'])) {
		$usuario = strtolower($_POST['user']);
		$password = hash('md5', $_POST['password']);
		$new_password = hash('md5', $_POST['new_password']);
		$confirm_password = hash('md5', $_POST['confirm_password']);

		if (!empty($usuario) && !empty($password) && !empty($new_password) && !empty($confirm_password)) {

			$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."' AND Password = '".$password."'");
			$num_rows = mysqli_num_rows($query);

			if ($num_rows != 0) {

				while ($row = mysqli_fetch_assoc($query)) {
					$dbusuario = strtolower($row['Usuario']);
	                $dbpassword = $row['Password'];
				}

				if ($usuario == $dbusuario && $dbpassword == $password) {

					$query_update = " UPDATE permissions SET Password = '".$new_password."', CambPwd = '0' WHERE Usuario = '".$usuario."' ";

					if (mysqli_query($con_user, $query_update)) {
						echo "<script>alert('Se actualizo correctamente tu password');</script>";
						echo "<script>window.location.href='index.php'</script>";
					} else {
						echo "<script>alert('Hubo un error al actualizar el password.');</script>";
						echo "Error: ".$query_update." --> ". mysqli_error($con_user);
					}
				
				}

			} else {
				echo "<script>alert('Usuario y/o Password Incorrectos.');</script>";
			}
		} else {
			echo "<script>alert('Favor de llenar los campos.');</script>";
		}
	}
?>
<body>

	<div data-role="page" data-theme="b" id="page">
		<div data-role="header" id="header">
			<h1>Cambiar Password
				<!--<br> 
				<center>
					<img src="public/images/Sicicon.ico">
				</center>-->
			</h1>
		</div>
		<form method="post" action="" data-ajax="false" id="form">
			<div data-role="content" id="content_login">
				<input type="text" id="user" name="user" placeholder="Usuario" required>
				<input type="password" id="password" name="password" placeholder="Password Actual" required>
				<input type="password" id="new_password" name="new_password" placeholder="Password Nuevo" required>
				<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmar Password" required>

				<div id="divBtnsCampos">
					<center>
						<input type="submit" id="btnCambiar" name="change" data-icon="check" data-inline="true" data-transition="pop" value="Cambiar">
						<input type="button" id="btnLimpiar" data-role="button" data-icon="refresh" data-inline="true" value="Limpiar">
					</center>
				</div>
			</div>

		</form>
	</div>
</body>
</html>
