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
	<div data-role="page" data-theme="b" id="divPage">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Codigos De Falla<br>Fault Codes
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
		<div id="divForm_CDF">
			<form action="">
				<center>
					<div data-role="fieldcontain" id="divContentModelo_CDF">
						<center>
							<label for="modelo"><b>Modelo</b></label>
						</center>
						<select name="modelo" id="selectModelo_CDF">
							<?php
								if ($area == 'electronica') {
									$query = mysqli_query($con1, "SELECT Codigo FROM codigos");
									$num_rows = mysqli_num_rows($query);

									if ($num_rows != 0) {
										while ($row = mysqli_fetch_assoc($query)) {
											echo "<option value=".$row['Codigo'].">".$row['Codigo']."</option>";
										}
									} else {
										echo "<script>alert('No se encontraron codigos');</script>";
									}
								}
							?>
							<?php
								if ($area == 'electromecanicos') {
									$query = mysqli_query($con2, "SELECT Codigo FROM codigos");
									$num_rows = mysqli_num_rows($query);

									if ($num_rows != 0) {
										while ($row = mysqli_fetch_assoc($query)) {
											echo "<option value=".$row['Codigo'].">".$row['Codigo']."</option>";
										}
									} else {
										echo "<script>alert('No se encontraron codigos');</script>";
									}
								}
							?>
							<?php
								if ($area == 'valvulas') {
									$query = mysqli_query($con3, "SELECT Codigo FROM codigos");
									$num_rows = mysqli_num_rows($query);

									if ($num_rows != 0) {
										while ($row = mysqli_fetch_assoc($query)) {
											echo "<option value=".$row['Codigo'].">".$row['Codigo']."</option>";
										}
									} else {
										echo "<script>alert('No se encontraron codigos');</script>";
									}
								}
							?>
						</select>
					</div>
				</center>
				<center>
					<div id="divBotonesCodigos">
						<!-- PopUp Agregar Codigos -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupAgregar" id="btnAgregar" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    						<div data-role="popup" id="popupAgregar" class="ui-content">
      							<label for="codigo">Codigo</label>
      							<input type="text" id="agregarCodigo">
      							<label for="registrar">Registrar como</label>
      							<input type="text" id="registrarComo">
      							<label for="descripcion">Descripcion</label>
      							<input type="text" id="agregarDescripcion">
								<a id="agregarCodigoConfirmacion" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelar" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<!-- PopUp Modificar Codigos -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupModificar" id="btnModificar" data-rel="popup" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline ui-corner">Modificar</a>
    						<div data-role="popup" id="popupModificar" class="ui-content">
      							<label for="operacion">Codigo</label>
      							<input type="text" id="modificaCodigo">
      							<label for="descripcion">Registrar como</label>
      							<input type="text" id="modificaRegistrarComo">
      							<label for="descripcion">Descripcion</label>
      							<input type="text" id="modificaDescripcion">
								<a id="guardarModificacion" href="#" data-role="button" data-icon="check" data-inline="true">Guardar</a>
								<a id="cancelarModificacion" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<!-- PopUp Eliminar Codigos -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupEliminar" id="btnEliminar" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    						<div data-role="popup" id="popupEliminar" class="ui-content">
      							<h3>Eliminar Codigo</h3><hr>
      							<p>Estas seguro de eliminar este <b>Codigo</b>???</p>
      							<center>
									<a id="eliminar" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
									<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
								</center>
    						</div>
  						</div>

  						<!-- PopUp Copiar Codigos-->
						<div data-role="main" class="ui-content">
    						<a href="#popupCopiar" id="btnCopia" data-rel="popup" class="ui-btn ui-icon-bars ui-btn-icon-left ui-btn-inline ui-corner">Copiar</a>
    						<div data-role="popup" id="popupCopiar" class="ui-content">
      							<h3>Copiar Codigos de Falla</h3><hr>
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

  						<!-- PopUp Importar Codigos-->
						<div data-role="main" class="ui-content">
    						<a href="#popupImportar" id="btnImporta" data-rel="popup" class="ui-btn ui-icon-action ui-btn-icon-left ui-btn-inline ui-corner">Importar</a>
    						<div data-role="popup" id="popupImportar" class="ui-content">
      							<h3>Importar Codigos de Falla</h3><hr>
								<div id="divModelo">
									<label for="modelo">Modelo</label>
									<input type="text">
								</div>
								<div id="divSelectHojas">
									<center><label for="hoja" data-theme="c"><b>Seleccione una hoja</b></label></center><br>
									<div id="listViewHojas">
										<ul data-role="listview">
											<li data-icon="false"><a href="">Aqui se cargan los archivos</a></li>
										</ul><hr>
									</div>
								</div><br>
      							<center>
									<a id="abrirDoc" href="#" data-role="button" data-icon="bullets" data-inline="true">Abrir Documento</a>
									<a id="importar" href="#" data-role="button" data-icon="action" data-inline="true">Importar</a>
								</center><br>
								<div id="divSelecAdvertencias">
									<center><label for="advertencia" data-theme="c"><b>Advertencias</b></label></center><br>
									<div id="listViewAdvertencias">
										<ul data-role="listview">
											<li data-icon="false"><a href="">Aqui aparecen las advertencias</a></li>
										</ul>
									</div>
								</div>
    						</div>
  						</div>
					</div>
				</center>
				<center>
				<div id="divTabla_CDF">
						<table id="tabla_CDF" cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr>
								<th width="100" align="left">Codigo</th>
								<th width="250" align="left">Registrar como</th>
								<th width="450" align="left">Descripcion</th>
							</tr>
						</thead>
						<tbody>
							<!--Primer Dato (Para el 2do hay que cambiar el id y el for)-->
							<tr>
								<td><span>Acalidad</span></td>
								<td><span>Auditoria de Calidad</span></td>
								<td><span>No</span></td>
							</tr>
				</div>
			</center>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../../../js/js_tables.js"></script>
</body>
</html>