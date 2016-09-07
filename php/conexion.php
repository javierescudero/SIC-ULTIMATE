<?php
	define("SERVER", "127.0.0.1");
	define("USER", "root");
	define("PASSWORD", "root");
	define("DB", "electronica");

	$con = mysqli_connect(SERVER, USER, PASSWORD, DB);

	if (!$con) {
		die("Conexion Fallida: " . mysqli_connect_error());
	} /*else {
		echo "Conexion exitosa";

		$usuario = "admin";
		$password = "Ittcchi42";

		$query = mysqli_query($con, "SELECT * FROM permissions WHERE usuario = '".$usuario."' AND password = '".$password."'");
		$num_rows = mysqli_num_rows($query);

		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$dbusuario = $row['user'];
                $dbpassword = $row['password'];
                $db_cap_modfam = $row['cap_modfam'];
                $db_cap_oper = $row['cap_oper'];
                $db_cap_comp = $row['cap_comp'];
                $db_cap_codes = $row['cap_codes'];
                $db_cap_registros = $row['cap_registros'];
                $db_rep_desp = $row['rep_desp'];
                $db_rep_graf = $row['rep_graf'];
                $db_rep_contrib = $row['rep_contrib'];
                $db_rep_correc = $row['rep_correc'];
                $dbusr = $row['usr'];
                $dbarea = $row['area'];
                $dbcambpwd = $row['cambpwd'];
                $dbtipo = $row['tipo'];
			}
			if ($usuario == $dbusuario && $dbpassword == $password) {
				switch ($dbtipo) {
					case 'administrador':
						$_SESSION['session_nombre_usuario'] = $dbusuario;
                    	header('Location: index.php');
						break;
				}
			}
		} else {
			echo "<script type='text/javascript'>";
			echo 	"alert('Datos incorrectos');";
			echo 	"window.location.href='../index.html';"; // ../index.html en firefox
			echo "</script>";
		}
	}*/
?>