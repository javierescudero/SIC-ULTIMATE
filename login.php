<!DOCTYPE html>
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
	<div data-role="page" data-theme="b" id="page">
		<div data-role="header" id="header">
			<center>
				<img src="public\images\Sicicon.ico">
			</center>
			<h1>SIC Ultimate<br> 
				<b>Login</b>
			</h1>
		</div>
		<form method="post" action="php/valida_user.php">
			<div data-role="content" id="content_login">
				<input type="text" id="user" name="user" placeholder="Usuario" required>
				<input type="password" id="password" name="password" placeholder="Password" required>
				<div id="divBtnsCampos">
					<center>
						<input type="submit" id="btnAceptar" data-role="button" data-icon="check" data-inline="true" data-transition="pop" value="Aceptar">
						<input type="button" id="btnCancelar" data-role="button" onclick="window.close();" data-icon="delete" data-inline="true" value="Cancelar">
					</center>
				</div>
			</div>
		</form>
	</div>
</body>
</html>