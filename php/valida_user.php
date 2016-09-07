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
		$query = mysqli_query($con, "SELECT * FROM permissions WHERE usuario = '".$usuario."' AND password = '".$password."'");
		$num_rows = mysqli_num_rows($query);

		if ($num_rows > 0) {
			echo "Entro al if de numrows <br>";
			while ($row = mysqli_fetch_assoc($query)) {
				echo "Entro al while <br>";
				$dbusuario = $row['Usuario'];
				echo "Usuario: ".$dbusuario."<br>";
                $dbpassword = $row['Password'];
                echo "Usuario: ".$dbpassword."<br>";
                $db_cap_modfam = $row['cap_modfam'];
                $db_cap_oper = $row['cap_Oper'];
                $db_cap_comp = $row['cap_comp'];
                $db_cap_codes = $row['cap_codes'];
                $db_cap_registros = $row['cap_Registros'];
                $db_rep_desp = $row['rep_desp'];
                $db_rep_graf = $row['rep_graf'];
                $db_rep_contrib = $row['rep_contrib'];
                $db_rep_correc = $row['rep_correc'];
                $dbusr = $row['Usr'];
                $dbarea = $row['Area'];
                $dbcambpwd = $row['CambPwd'];
                $dbtipo = $row['tipo'];
                echo "Usuario: ".$dbtipo."<br>";
			}
			if ($usuario == $dbusuario && $dbpassword == $password) {
				echo "Entro al if de user$pasword<br>";
				switch ($dbtipo) {
					case 'administrador':
						$_SESSION['session_nombre_usuario'] = $dbusuario;
						header('Location: ../index.html');
						break;
				} //Fin del switch
				echo "NO entro al Switch<br>";
			}
		} else {
			echo "numrows es < 0 <br>";
		}
	} else {
		echo "Campos vacios <br>";
	}
?>
</body>
</html>