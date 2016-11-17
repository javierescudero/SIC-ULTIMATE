<?php
	require_once("../conexion.php");
	if (isset($_GET['area'])) {
		if (isset($_GET['tipoUser'])) {
			$area = $_GET['area'];
			$tipoUser = $_GET['tipoUser'];
		}
	}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>SIC Ultimate</title>

	<?php include("../../php/librerias.php"); ?>
</head>
<body>
	<?php
		function cargaModelos($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT Modelo FROM modelos");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value=".$row['Modelo'].">".$row['Modelo']."</option>";
			}
			mysqli_close($con);
		}
	?>
	<div data-role="page" data-theme="b" id="">
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Operaciones<br>Operations
				<!--<center>
					<img src="../../public/images/Sicicon.ico">
				</center>-->
			</h1>
		</div>
		<?php
			if ($tipoUser == 'administrador') {
				include("../menus/menu_administrador.php");
			} 
			elseif ($tipoUser == 'capturistaA') {
				include("../menus/menu_capturistaA.php");
			} 
			elseif ($tipoUser == 'capturistaB') {
				include("../menus/menu_capturistaB.php");
			} 
			elseif ($tipoUser == 'capturistaC') {
				include("../menus/menu_capturistaC.php");
			} 
			elseif ($tipoUser == 'capturistaD') {
				include("../menus/menu_capturistaD.php");
			} 
			elseif ($tipoUser == 'consultorA') {
				include("../menus/menu_consultorA.php");
			} 
			elseif ($tipoUser == 'consultorB') {
				include("../menus/menu_consultorB.php");
			} 
			elseif ($tipoUser == 'correctorA') {
				include("../menus/menu_correctorA.php");
			}
		?>

		<div id="divForm_Op">
			<form action="">
				<center>
					<div data-role="fieldcontain" id="divContentModelo_Op">
						<center>
							<label for="modelo"><b>Modelo</b></label>
						</center>
						<select name="modelo" id="modelo">
							<?php
								if ($area == 'electronica') {
									cargaModelos($con, 'electronica');
								} elseif ($area == 'electromecanicos') {
									cargaModelos($con, 'electromecanicos');
								} elseif ($area == 'valvulas') {
									cargaModelos($con, 'valvulas');
								}
							?>
						</select>
					</div>
				</center>
				<center>
					<div id="divBtnsOperaciones_Op">
						<!-- PopUp Agregar Operacion -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupAgregar" id="btnAgregar" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    						<div data-role="popup" id="popupAgregar" class="ui-content">
      							<label for="operacion">Operacion</label>
      							<input type="text" id="agregarOperacion">
      							<label for="descripcion">Descripcion</label>
      							<input type="text" id="agregarDescripcion">
      							<fieldset data-iconpos="right">
      								<input name="checkbox" id="checkbox-h-6c" type="checkbox">
        							<label for="checkbox-h-6c">Usar en PPms?</label>
      							</fieldset>
      							<label for="grupo">Grupo</label>
      							<select name="agregarGrupo" id="agregarGrupo">
									<option value="default">- - - - - - -</option>
									<option value="final_test">Final Test</option>
									<option value="qc_audit">QC Audit</option>
									<option value="process">Process</option>
								</select>
								<a id="agregarOperacionConfirmacion" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelar" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<!-- PopUp Modificar Operacion -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupModificar" id="btnModificar" data-rel="popup" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline ui-corner">Modificar</a>
    						<div data-role="popup" id="popupModificar" class="ui-content">
      							<label for="operacion">Operacion</label>
      							<input type="text" id="modificaOperacion">
      							<label for="descripcion">Descripcion</label>
      							<input type="text" id="modificaDescripcion">
      							<fieldset data-iconpos="right">
      								<input name="checkbox" id="checkbox-h-6a" type="checkbox">
        							<label for="checkbox-h-6a">Usar en PPms?</label>
      							</fieldset>
      							<label for="grupo">Grupo</label>

      							<select name="modificaGrupo" id="modificaGrupo">
									<option value="default">- - - - - - -</option>
									<option value="final_test">Final Test</option>
									<option value="qc_audit">QC Audit</option>
									<option value="process">Process</option>
								</select>
								<a id="guardarModificacion" href="#" data-role="button" data-icon="check" data-inline="true">Guardar</a>
								<a id="cancelarAgregado" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<!-- PopUp Eliminar Operacion -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupEliminar" id="btnEliminar" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    						<div data-role="popup" id="popupEliminar" class="ui-content">
      							<h3>Eliminar Operacion</h3><hr>
      							<p>Estas seguro de eliminar esta <b>Operacion</b>???</p>
      							<center>
									<a id="eliminar" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
									<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
								</center>
    						</div>
  						</div>

  						<!-- PopUp Copiar Operacion-->
						<div data-role="main" class="ui-content">
    						<a href="#popupCopiar" id="btnCopia" data-rel="popup" class="ui-btn ui-icon-bars ui-btn-icon-left ui-btn-inline ui-corner">Copiar</a>
    						<div data-role="popup" id="popupCopiar" class="ui-content">
      							<h3>Copiar Operaciones</h3><hr>
								<div data-role="fieldcontain" id="">
									<center><label for="mod_origen"><b>Modelo Origen</b></label></center>
									<select name="mod_origen" id="mod_origen">
										<option value="">0016 496900</option>
										<option value="">0059 419100</option>
										<option value="">50C70 495</option>
									</select>
								</div>
								<div data-role="fieldcontain" id="">
									<center><label for="mod_destino"><b>Modelo Destino</b></label></center>
									<select name="mod_destino" id="mod_destino">
										<option value="">50M61 843</option>
										<option value="">F59-478100</option>
										<option value="">50A51 235B1</option>
									</select>
								</div>
      							<center>
									<a id="copiar" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
									<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
								</center>
    						</div>
  						</div>
					</div>
				</center>
				<center>
				<div id="divTabla_Op">
						<table id="tabla_Op" cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr>
								<th width="60" align="left">Operacion</th>
								<th width="280" align="left">Descripcion</th>
								<th width="130" align="left">Usar en PPms?</th>
								<th width="120" align="left">Grupo</th>
							</tr>
						</thead>
				</div>
			</center>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../../../js/js_tables.js"></script>
</body>
</html>