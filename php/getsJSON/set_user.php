<?php
	session_start();
	require_once("../conexion.php");

	if ($_REQUEST['ajax']) {
		$usuario = strtolower($_REQUEST['usuario']);
		$password = hash('md5', $_REQUEST['password']);
		$modelos = $_REQUEST['modelos'];
		$operaciones = $_REQUEST['operaciones'];
		$componentes = $_REQUEST['componentes'];
		$codigos = $_REQUEST['codigos'];
		$registros = $_REQUEST['registros'];
		$usuarios = $_REQUEST['usuarios'];
		$desempeno = $_REQUEST['desempeno'];
		$tendencia = $_REQUEST['tendencia'];
		$contribuyentes = $_REQUEST['contribuyentes'];
		$correccion = $_REQUEST['correccion'];
		$electronica = $_REQUEST['electronica'];
		$electromecanicos = $_REQUEST['electromecanicos'];
		$valvulas = $_REQUEST['valvulas'];

		$array = array();

		$areas = "";


		if ($modelos == 'false') { $mod = 0; } 
		else { $mod= 1; }
		array_push($array, $mod);

		if ($operaciones == 'false') { $ope = 0; } 
		else { $ope = 1; }
		array_push($array, $ope);

		if ($componentes == 'false') { $com = 0; } 
		else { $com = 1; }
		array_push($array, $com);

		if ($codigos == 'false') { $cod = 0; } 
		else { $cod = 1; }
		array_push($array, $cod);

		if ($registros == 'false') { $reg = 0; }
		else { $reg = 1; }
		array_push($array, $reg);

		if ($usuarios == 'false') { $usu = 0; } 
		else { $usu = 1; }
		array_push($array, $usu);

		if ($desempeno == 'false') { $des = 0; } 
		else { $des = 1; }
		array_push($array, $des);

		if ($tendencia == 'false') { $ten = 0; } 
		else { $ten = 1; }
		array_push($array, $ten);

		if ($contribuyentes == 'false') { $con = 0; } 
		else { $con = 1; }
		array_push($array, $con);

		if ($correccion == 'false') { $cor = 0; } 
		else { $cor = 1; }
		array_push($array, $cor);

		if ($electronica == 'true') { $areas .= "Electronica, "; }


		if ($electromecanicos == 'true') { $areas .= "Electromecanicos, "; }

		if ($valvulas == 'true') { $areas .= "Valvulas,"; }

		$tipo_usuario = implode("", $array);

		if ($tipo_usuario == '1111111111') { $tipo = 'administrador'; }
		elseif ($tipo_usuario == '1111100000') { $tipo = 'capturistaA'; }
		elseif ($tipo_usuario == '1111101110') { $tipo = 'capturistaB'; }
		elseif ($tipo_usuario == '1111100001') { $tipo = 'capturistaC'; }
		elseif ($tipo_usuario == '1111101111') { $tipo = 'capturistaD'; }
		elseif ($tipo_usuario == '0000001110') { $tipo = 'consultorA'; }
		elseif ($tipo_usuario == '0000001111') { $tipo = 'consultorB'; }
		elseif ($tipo_usuario == '0000000001') { $tipo = 'correctorA'; }
		else { $tipo = 'otro'; }

		$query = mysqli_query($con_user, "SELECT * FROM permissions WHERE Usuario = '".$usuario."'");
		$num_rows = mysqli_num_rows($query);
		if ($num_rows != 0) {

			$query_update = " UPDATE permissions SET cap_modfam = '".$mod."', cap_Oper = '".$ope."', cap_comp = '".$com."', cap_codes = '".$cod."', cap_Registros = '".$reg."', rep_desp = '".$des."', rep_graf = '".$ten."', rep_contrib = '".$con."', rep_correc = '".$cor."', Area = '".$areas."', tipo = '".$tipo."' WHERE Usuario = '".$usuario."' ";

			if (mysqli_query($con_user, $query_update)) {
				$rows[] = 'actualizado';
				print(json_encode($rows));
				//print_r($query);
			} else {
				$rows[] = 'error';
				print(json_encode($rows));
			}

		} else {
			$rows[] = 'noencontrado';
			print(json_encode($rows));
		}
	}
?>