<?php
	session_start();
	require_once("../../../php/conexion.php");

	if (isset($_POST['btnAgregar'])) {
		echo "<script>alert('btnAgregar Variable valida');</script>";
		
		$usuario = strtolower($_POST['usuario']);
		$password = hash('md5', $_POST['password']);
		
		if (!empty($usuario) && !empty($password)) {
			$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."' AND Password = '".$password."'");
			$num_rows = mysqli_num_rows($query);
			if ($num_rows != 0) {
				echo "<script>alert('Usuario ya existe');</script>";
			} else {
				$areas = "";
				$cambiar_password = $_POST['flip-1']; // si || no
				if ($cambiar_password == 'si') {
					$cambiar_password = 1;
				} else {
					$cambiar_password = 0;
				}
				$cap_modelos = $_POST['checkModelos']; // on || off
				if ($cap_modelos == 'on') {
					$cap_modelos = 1;
				} else {
					$cap_modelos = 0;
				}
				$cap_operaciones = $_POST['checkOperaciones'];
				if ($cap_operaciones == 'on') {
					$cap_operaciones = 1;
				} else {
					$cap_operaciones = 0;
				}
				$cap_componentes = $_POST['checkComponentes'];
				if ($cap_componentes == 'on') {
					$cap_componentes = 1;
				} else {
					$cap_componentes = 0;
				}
				$cap_codigos = $_POST['checkCodigos'];
				if ($cap_codigos == 'on') {
					$cap_codigos = 1;
				} else {
					$cap_codigos = 0;
				}
				$cap_registros = $_POST['checkRegistros'];
				if ($cap_registros == 'on') {
					$cap_registros = 1;
				} else {
					$cap_registros = 0;
				}
				$cap_usuarios = $_POST['checkUsuarios'];
				if ($cap_usuarios == 'on') {
					$cap_usuarios = 1;
				} else {
					$cap_usuarios = 0;
				}
				$rep_desempeno = $_POST['checkDesempeno'];
				if ($rep_desempeno == 'on') {
					$rep_desempeno = 1;
				} else {
					$rep_desempeno = 0;
				}
				$rep_tendencia = $_POST['checkTendencia'];
				if ($rep_tendencia == 'on') {
					$rep_tendencia = 1;
				} else {
					$rep_tendencia = 0;
				}
				$rep_contribuyentes = $_POST['checkContribuyentes'];
				if ($rep_contribuyentes == 'on') {
					$rep_contribuyentes = 1;
				} else {
					$rep_contribuyentes = 0;
				}
				$rep_correccion = $_POST['checkCorreccion'];
				if ($rep_correccion == 'on') {
					$rep_correccion = 1;
				} else {
					$rep_correccion = 0;
				}
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

				if ($area_electronica != 'on' && $area_electromecanicos != 'on' && $area_valvulas != 'on') {
					echo "<script>alert('Usuario ya existe');</script>";
				}

				$query = "INSERT INTO permissions (Usuario, Password, cap_modfam, cap_Oper, cap_comp, cap_codes, cap_Registros, rep_desp, rep_graf, rep_contrib, rep_correc, Usr, Area, CambPwd) VALUES ('".$usuario."', '".$password."', '".$cambiar_password."', '".$cap_modelos."', '".$cap_operaciones."', '".$cap_componentes."', '".$cap_codigos."', '".$cap_registros."', '".$cap_usuarios."', '".$rep_desempeno."', '".$rep_tendencia."', '".$rep_contribuyentes."', '".$rep_correccion."', '".$areas."')";

				if (mysqli_query($con_user, $query)) {
					echo "New record created successfully";
					echo "<br>";
					echo "".$query;
					return false;
				} else {
					echo "Error: " . $query . "<br>" . mysqli_error($con_user);
					return false;
				}
			}
		} else {
			echo "<script>alert('Usuario o Password vacios');</script>";
		}

		echo "<script>window.location.href='permisos.php'</script>";

	} elseif (isset($_POST['btnModificar'])) {
		echo "<script>alert('btnModificar Variable valida');</script>";
		echo "<script>window.location.href='permisos.php'</script>";

	} elseif (isset($_POST['btnBorrar'])) {
		echo "<script>alert('btnBorrar Variable valida');</script>";
		echo "<script>window.location.href='permisos.php'</script>";

	} elseif (isset($_POST['btnCancelar'])) {
		echo "<script>alert('btnCancelar Variable valida');</script>";
		echo "<script>window.location.href='permisos.php'</script>";

	}
?>