<?php
	require_once("../conexion.php");
	if (isset($_GET['area'])) {
		if (isset($_GET['tipoUser'])) {
			$area = $_GET['area'];
			$tipoUser = $_GET['tipoUser'];
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>SIC Ultimate</title>

	<script src="../../js/jquery-1.12.4.min.js"></script>
	<script src="../../js/jquery.mobile-1.4.5.js"></script>
	<script src="../../js/js_refresh.js"></script>
	
	<link rel="stylesheet" href="../../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../../css/css_style.css">

	<script src="../../js/jqm-datebox-1.4.5.core.min.js"></script>
	<script src="../../js/jqm-datebox.lang.utf8.js"></script>
	<script src="../../js/jqm-datebox-1.4.5.mode.calbox.min.js"></script>
	<link rel="stylesheet" href="../../css/jqm-datebox-1.4.5.min.css">
	
</head>
<style type="text/css">
	@media screen and (min-width: 480px) {
	}
	@media screen and (max-width: 1800px) {
		.ui-grid-b {
			width: 70%;
			margin-left: 15%;
		}
	}
</style>
<body>
	<?php
		function cargaFamilias($conn, $database) {
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Familias FROM familias ORDER BY Familias");
			$num_rows = mysqli_num_rows($query);
			if ($num_rows != 0) {
				while ($row = mysqli_fetch_assoc($query)) {
					echo "<option value='".$row['Familias']."'>".$row['Familias']."</option>";
				}
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($con);
			}
			mysqli_close($con);
		}
	?>
	<div data-role="page" data-theme="b" class="ui-responsive-panel">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Registros<br>Records
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

		<div id="divForm_Reg">
			<form action="" id="form_registros">
				<div class="ui-grid-b">
					<div class="ui-block-a">
						
						<label for="fecha"><b>Fecha</b></label>
						<div class="ui-field-contain" id="divFecha" title="Fecha">
            				<input name="fecha" id="fecha" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>

          				<div style="display:none">
            				<input name="langpicker" type="text" data-role="datebox" data-datebox-close-callback="changeLang" data-datebox-custom-data="langs" data-datebox-custom-head="Language" data-datebox-popup-position="window" data-datebox-override-custom-set="Choose" data-datebox-mode="customflip" id="langpicker" />
          				</div>
          				
          				<label for="turno"><b>Turno</b></label>
          				<div class="ui-field-contain" id="divTurno_Reg">
          					<select name="turno" id="turno" data-role="slider" data-theme="b" data-track-theme="b">
                				<option value="1">1</option>
                				<option value="3">3</option>
        					</select>
          				</div>
          				
          				<label for="linea"><b>Linea</b></label>
          				<div class="ui-field-contain" id="divNumLinea_Reg">
          					<select name="linea" id="Linea">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
								<option value="11">11</option>
								<option value="12">12</option>
							</select>
          				</div>
					</div>
					<div class="ui-block-b">

          				<script type="text/javascript">
      						//Carga los modelos al seleccionar una familia.
							var loadMod = $("select#modelos");
							$(function() {
								$("select#familias").change(function() {
									//Carga los modelos al seleccionar una familia.
									$.getJSON("../getsJSON/get_modelos.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="default">- - - Selecciona Un Modelo - - -</option>\n';

										for (var i = 0; i < j.length; i++) {				
											options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
										}
										$("select#modelos").html(options);
									});

									//Carga las operaciones al seleccionar una familia.
									$.getJSON("../getsJSON/get_operaciones_xFamilia_reg.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="default">- - - Selecciona Una Operacion - - -</option>\n';

										for (var i = 0; i < j.length; i++) {				
											options += '<option value="'+ j[i].Operacion +'">'+ j[i].Operacion +'</option> \n';
										}
										$("select#operaciones").html(options);
									});

								});
							});
          				</script>

          				<!-- FAMILIAS -->
          				<label for="familia"><b>Familia</b></label>
						<div class="ui-field-contain" id="divFamilia_Reg" title="Familias">
            				<select name="familias" id="familias">
            					<option value="default">- - - Selecciona Una Familia - - -</option>
								<?php
									if ($area == 'Electronica') {
										cargaFamilias($con, 'Electronica');
									} elseif ($area == 'Electromecanicos') {
										cargaFamilias($con, 'Electromecanicos');
									} elseif ($area == 'Valvulas') {
										cargaFamilias($con, 'Valvulas');
									}
								?>
							</select>
          				</div>

          				<script type="text/javascript">
      						//Carga las operaciones al seleccionar modelo
							$(function() {
								$("select#modelos").change(function() {

									//Carga los modelos al seleccionar una familia.
									$.getJSON("../getsJSON/get_operaciones_xModelo_reg.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="default">- - - Selecciona Una Operacion - - -</option>\n';

										for (var i = 0; i < j.length; i++) {				
											options += '<option value="'+ j[i].Operacion +'">'+ j[i].Operacion +'</option> \n';
										}
										$("select#operaciones").html(options);
									});

									//Carga los codigos al seleccionar un modelo.
									$.getJSON("../getsJSON/get_codigos_reg.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="default">- - - Codigos - - -</option>\n';

										for (var i = 0; i < j.length; i++) {				
											options += '<option value="'+ j[i].Codigo +'">'+ j[i].Codigo +'</option> \n';
										}
										$("select#codigos").html(options);
									});

									//Carga los componentes al seleccionar un modelo.
									$.getJSON("../getsJSON/get_componentes.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="default">- - - Componentes - - -</option>\n';

										for (var i = 0; i < j.length; i++) {				
											options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';
										}
										$("select#componentes").html(options);
									});

								});
							});
          				</script>

          				<script type="text/javascript">
							/*$(function() {
								
								//Agregar Codigos
								$("a#agregarCodigoConfirmacion").click(function(){
									var valCodigo = document.getElementById('agregarCodigo').value;
									alert('valCodigo = ' + valCodigo);
									var valregistrarComo = document.getElementById('registrarComo').value;
									alert('valregistrarComo = ' + valregistrarComo);
									var valDescripcion = document.getElementById('agregarDescripcion').value;
									alert('valDescripcion = ' + valDescripcion);
									var valModelo = document.getElementById('selectModelo_CD').value;
									alert('valModelo = ' + valModelo);

									$.getJSON("../getsJSON/add_Codigos.php", {ajax: true, modelo: valModelo, codigo: valCodigo, registrarAs: valregistrarComo, descripcion: valDescripcion,  area: <?php echo "'$area'"; ?> }, function(j) {
										var tr = "";
										for (var i = 0; i < j.length; i++) {

											tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
								
											tr += '<td><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

											tr += '<td><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

											tr += '<td><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

										}
										$("tbody#content_codigos").html(tr);

										valCodigo = document.getElementById('agregarCodigo').value = '';
										valregistrarComo = document.getElementById('registrarComo').value = '';
										valDescripcion = document.getElementById('agregarDescripcion').value = '';

										$('#cancelarAdd').click();

									});
								});

								$(document).ready(function(e) {
									//$("select#familias").change();
									$("select#modelos").change();
								});
							});*/
						</script>

          				<!-- MODELOS -->
          				<label for="familia"><b>Modelos</b></label>
						<div class="ui-field-contain" id="divModelo_Reg" title="Modelos">
            				<select name="modelos" id="modelos">
            					<option value="default">- - - Selecciona Un Modelo - - -</option>
							</select>
          				</div>

          				<!-- OPERACIONES -->
          				<label for="operacion"><b>Operacion</b></label>
          				<div class="ui-field-contain" id="divOperacion_Reg" title="Operaciones">
            				<select name="operaciones" id="operaciones">
            					<option value="default">- - - Selecciona Una Operacion - - -</option>
							</select>
          				</div>
					</div>

					<div class="ui-block-c">
						<label for="empleado"><b># de Empleado</b></label>
          				<div class="ui-field-contain" id="divEmpleado_Reg" title="Numero de Empleado">
            				<input name="empleado" id="empleado" type="number" min="1" max="99999" size="5">
          				</div>
          				<label for="produccion"><b>Produccion</b></label>
	      				<div class="ui-field-contain" id="divProduccion_Reg" title="Produccion">
	        				<input name="produccion" id="produccion" type="number" min="1">
	      				</div>
	      				<label for="piezas"><b>Piezas Rechazadas</b></label>
	      				<div class="ui-field-contain" id="divPzRechazadas_Reg" title="Piezas rechazadas">
	        				<input name="piezas" id="piezas" type="number" min="0" max="99999" size="5">
	      				</div>
					</div>
				</div>
				<!--<center>
					<a href="" id="btnAgregaModelo" data-role="button" data-inline="true" onclick="window.open('fam&mod.php');">Agregar Modelos / Familia</a>
          			<a href="" id="btnAgregaComponente" data-role="button" data-inline="true" onclick="window.open('componentes.php');">Agregar Componentes</a>
          			<a href="" id="btnAgregaCodigo" data-role="button" data-inline="true" onclick="window.open('codigos_de_falla.php');">Agregar Codigos De Falla</a>
				</center><br>-->

				<script type="text/javascript">
					$(document).ready(function() {
						//Agregar Operacion
						$("a#agregarRegistro").click(function(){
							alert('Click Guardar');

							var valCodigo = document.getElementById('codigos').value;
							var valComponente = document.getElementById('componentes').value;
							var valCantidad = document.getElementById('cantidad').value;
							
							alert('Componente = ' + valComponente);
							
							var tr = "";

							tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id=""></fieldset></td>';
									
							tr += '<td><select name="'+valCodigo+'" id="'+valCodigo+'"><option value="'+valCodigo+'">'+valCodigo+'</option></select></td>';
									
							tr += '<td><select name="'+valComponente+'" id="'+valComponente+'"><option value="'+valComponente+'">'+valComponente+'</option></select></td>';

							tr += '<td><input name="cantidad" id="cantidad" type="number" min="0" max="99999" size="5" value='+valCantidad+'></td>';

							$("tbody#content_registros").html(tr);

						});
						

						$(document).ready(function(e) {
							//$("select#familias").change();
							$("select#codigos").change();
							$("select#componentes").change();
						});
					});
				</script>

				<!-- PopUp Agregar Registros -->
				<div data-role="main" class="ui-content">
					<div data-role="popup" id="popupAgregar" class="ui-content">
						<label for="codigos">Codigos</label>
						<select name="codigos" id="codigos">
							<option value="default">- - - Codigos - - -</option>
						</select>
						<label for="componentes">Componentes</label>
						<select name="componentes" id="componentes">
							<option value="default">- - - Componentes - - -</option>
						</select>
						<input type="number" id="cantidad" name="cantidad" placeholder="Cantidad">
						<a id="agregarRegistro" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
						<a id="cancelarAdd" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
					</div>
				</div>
				<center>
					<a href="" data-role="button" id="guardar" data-icon="check" data-inline="true">Guardar</a>
					<a href="" data-role="button" id="limpiar" data-icon="refresh" data-inline="true">Limpiar</a>
					<a href="#popupAgregar" id="btnAgregar" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
					<a href="" data-role="button" id="eliminar" data-icon="delete" data-inline="true">Eliminar</a>
				</center><br>
				
				<!-- Tabla -->
				<center>
				<div id="divTabla_Reg">
					<table id="tabla_Reg" cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr>
								<th width="60" align="left">Selec</th>
								<th width="60" align="left">Codigo</th>
								<th width="280" align="left">Componente</th>
								<th width="130" align="left">Cantidad</th>
							</tr>
						</thead>
						<tbody id="content_registros">
						</tbody>
					</table>
				</div>
			</center>
			</form>
		</div>
	</div>
</body>
</html>