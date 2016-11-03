<?php
	session_start();
	require_once("../../../php/conexion.php");
	$array = array();

	if (isset($_POST['btnAgregar'])) {
		
		$usuario = strtolower($_POST['usuario']);
		$password = hash('md5', $_POST['password']);
		
		if (!empty($usuario) && !empty($password)) {
			$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."' AND Password = '".$password."'");
			$num_rows = mysqli_num_rows($query);
			if ($num_rows != 0) {
				echo "<script>alert('Usuario ya existe');</script>";
			} else {
				$areas = "";

				$cap_modelos = $_POST['checkModelos']; // on || off
				if ($cap_modelos == 'on') {
					$cap_modelos = 1;
				} else {
					$cap_modelos = 0;
				}
				array_push($array, $cap_modelos);

				$cap_operaciones = $_POST['checkOperaciones'];
				if ($cap_operaciones == 'on') {
					$cap_operaciones = 1;
				} else {
					$cap_operaciones = 0;
				}
				array_push($array, $cap_operaciones);

				$cap_componentes = $_POST['checkComponentes'];
				if ($cap_componentes == 'on') {
					$cap_componentes = 1;
				} else {
					$cap_componentes = 0;
				}
				array_push($array, $cap_componentes);

				$cap_codigos = $_POST['checkCodigos'];
				if ($cap_codigos == 'on') {
					$cap_codigos = 1;
				} else {
					$cap_codigos = 0;
				}
				array_push($array, $cap_codigos);

				$cap_registros = $_POST['checkRegistros'];
				if ($cap_registros == 'on') {
					$cap_registros = 1;
				} else {
					$cap_registros = 0;
				}
				array_push($array, $cap_registros);

				$rep_desempeno = $_POST['checkDesempeno'];
				if ($rep_desempeno == 'on') {
					$rep_desempeno = 1;
				} else {
					$rep_desempeno = 0;
				}
				array_push($array, $rep_desempeno);

				$rep_tendencia = $_POST['checkTendencia'];
				if ($rep_tendencia == 'on') {
					$rep_tendencia = 1;
				} else {
					$rep_tendencia = 0;
				}
				array_push($array, $rep_tendencia);

				$rep_contribuyentes = $_POST['checkContribuyentes'];
				if ($rep_contribuyentes == 'on') {
					$rep_contribuyentes = 1;
				} else {
					$rep_contribuyentes = 0;
				}
				array_push($array, $rep_contribuyentes);

				$rep_correccion = $_POST['checkCorreccion'];
				if ($rep_correccion == 'on') {
					$rep_correccion = 1;
				} else {
					$rep_correccion = 0;
				}
				array_push($array, $rep_correccion);

				$cap_usuarios = $_POST['checkUsuarios'];
				if ($cap_usuarios == 'on') {
					$cap_usuarios = 1;
				} else {
					$cap_usuarios = 0;
				}
				array_push($array, $cap_usuarios);

				$area_electronica = $_POST['checkElectronica'];
				if ($area_electronica == 'on') {
					$areas .= "Electronica,";
				}

				$area_electromecanicos = $_POST['checkElectromecanicos'];
				if ($area_electromecanicos == 'on') {
					$areas .= "Electromecanicos,";
				}

				$area_valvulas = $_POST['checkValvulas'];
				if ($area_valvulas == 'on') {
					$areas .= "Valvulas,";
				}

				$cambiar_password = $_POST['flip-1']; // si || no
				if ($cambiar_password == 'si') {
					$cambiar_password = 1;
				} else {
					$cambiar_password = 0;
				}

				$tipo_usuario = implode("", $array);

				if ($tipo_usuario == '1111111111') {
					$tipo = 'administrador';
				} elseif ($tipo_usuario == '1111100000') {
					//capturistaA
					$tipo = 'capturistaA';
				} elseif ($tipo_usuario == '1111111100') {
					//capturistaB
					$tipo = 'capturistaB';
				} elseif ($tipo_usuario == '1111100010') {
					//capturistaC
					$tipo = 'capturistaC';
				} elseif ($tipo_usuario == '1111111110') {
					//capturistaD
					$tipo = 'capturistaD';
				} elseif ($tipo_usuario == '0000011100') {
					//consultorA
					$tipo = 'consultorA';
				} elseif ($tipo_usuario == '0000011110') {
					//consultorB
					$tipo = 'consultorB';
				} elseif ($tipo_usuario == '0000000010') {
					//correctorA
					$tipo = 'correctorA';
				} else {
					$tipo = 'otro';
				}
				
				if ($area_electronica != 'on' && $area_electromecanicos != 'on' && $area_valvulas != 'on') {
					echo "<script>alert('Debes seleccionar al menos un area');</script>";
				} else {
					$query = "INSERT INTO permissions (Usuario, Password, cap_modfam, cap_Oper, cap_comp, cap_codes, cap_Registros, rep_desp, rep_graf, rep_contrib, rep_correc, Usr, Area, CambPwd, tipo) VALUES ('".$usuario."', '".$password."', '".$cap_modelos."', '".$cap_operaciones."', '".$cap_componentes."', '".$cap_codigos."', '".$cap_registros."', '".$rep_desempeno."', '".$rep_tendencia."', '".$rep_contribuyentes."', '".$rep_correccion."', '".$cap_usuarios."', '".$areas."', '".$cambiar_password."', '".$tipo."')";

					if (mysqli_query($con_user, $query)) {
						echo "<script>alert('Usuario agregado con exito');</script>";
					} else {
						echo "Error: " . $query . "<br>" . mysqli_error($con_user);
						return false;
					}
				}

			}
		} else {
			echo "<script>alert('Usuario o Password vacios');</script>";
		}
		echo "<script>window.location.href='permisos.php'</script>";

	} elseif (isset($_POST['btnModificar'])) {
		$usuario = strtolower($_POST['usuario']);
		$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."'");
		$num_rows = mysqli_num_rows($query);
		if ($num_rows != 0) {
			while ($row = mysqli_fetch_assoc($query)) {
				$usuario = strtolower($row['usuario']);
				$password = $row['password'];
				$cambiar_password = $row['flip-1'];
				$cap_modelos = $row['checkModelos'];
				$cap_operaciones = $row['checkOperaciones'];
				$cap_componentes = $row['checkComponentes'];
				$cap_codigos = $row['checkCodigos'];
				$cap_registros = $row['checkRegistros'];
				$cap_usuarios = $row['checkUsuarios'];
				$rep_desempeno = $row['checkDesempeno'];
				$rep_tendencia = $row['checkTendencia'];
				$rep_contribuyentes = $row['checkContribuyentes'];
				$rep_correccion = $row['checkCorreccion'];
				$area_electronica = $row['checkElectronica'];
				$area_electromecanicos = $row['checkElectromecanicos'];
				$area_valvulas = $row['checkValvulas'];
			}
		} else {
			echo "<script>alert('Usuario no existe');</script>";
			?>
			<script type="text/javascript">
			$(document).ready(function() {
				document.getElementById('usuario').innerHTML = <?php echo $usuario ?>;
			});
			</script>
			<?php
		}

		if (mysqli_query($con_user, $query)) {
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($con_user);
				return false;
			}

		echo "<script>window.location.href='permisos.php'</script>";
	} elseif (isset($_POST['btnBorrar'])) {
		$usuario = strtolower($_POST['usuario']);
		$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."'");
		$num_rows = mysqli_num_rows($query);
		if ($num_rows != 0) {
			$query = "DELETE FROM permissions WHERE Usuario = '".$usuario."'";
			if (mysqli_query($con_user, $query)) {
				echo "<script>alert('Eliminacion Exitosa...');</script>";
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($con_user);
				return false;
			}
		} else {
			echo "<script>alert('Usuario no existe');</script>";
		}
		echo "<script>window.location.href='permisos.php'</script>";
	} elseif (isset($_POST['btnCancelar'])) {
		echo "<script>window.location.href='permisos.php'</script>";
	} elseif (isset($_POST['btnBuscar'])) {
		echo "<script>window.location.href='permisos.php'</script>";
	}
?>