<?php
	session_start();
	include("conexion.php");
?>
<html>
<body>
<?php
	$usuario = $_POST['user'];
	$password = hash('md5', $_POST['password']);
	
	if (!empty($usuario) && !empty($password)) {	
		$query = mysqli_query($con, "SELECT * FROM permissions WHERE Usuario = '".$usuario."' AND Password = '".$password."'");
		$num_rows = mysqli_num_rows($query);

		if ($num_rows > 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$dbusuario = $row['Usuario'];
				//echo "Usuario: ".$dbusuario."<br>";
                $dbpassword = $row['Password'];
                //echo "Usuario: ".$dbpassword."<br>";
                $dbcambpwd = $row['CambPwd'];
                $dbtipo = $row['tipo'];
                //echo "Usuario: ".$dbtipo."<br>";
			}
			if ($usuario == $dbusuario && $dbpassword == $password) {
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
?>
</body>
</html>