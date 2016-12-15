<?php
	require_once("../conexion.php");
	mb_internal_encoding('UTF-8');
	mb_http_output('UTF-8');
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
          					<select name="linea" id="linea">
								<option value="Default">- - - Selecciona Un Turno - - -</option>
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
							$(function() {
								$("#familias").change(function() {
									
									//Carga los modelos al seleccionar una familia.
									$.getJSON("../getsJSON/get_modelos.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="Default">- - - Selecciona Un Modelo - - -</option>\n';
										if (j[0] == '') {

										} else {
											for (var i = 0; i < j.length; i++) {				
												options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
											}
										}
										$("#modelosReg").html(options);
									});

									//Carga las operaciones al seleccionar una familia.
									$.getJSON("../getsJSON/get_operaciones_xFamilia_reg.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="Default">- - - Selecciona Una Operacion - - -</option>\n';
										if (j[0] == '') {

										} else {
											for (var i = 0; i < j.length; i++) {				
												options += '<option value="'+ j[i].Operacion +'">'+ j[i].Operacion +'</option> \n';
											}
										}
										$("#operacionesReg").html(options);
									});

								});
							});
          				</script>

          				<!-- FAMILIAS -->
          				<label for="familia"><b>Familia</b></label>
						<div class="ui-field-contain" id="divFamilia_Reg" title="Familias">
            				<select name="familias" id="familias">
            					<option value="Default">- - - Selecciona Una Familia - - -</option>
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

							$(function() {
								$("#modelosReg").change(function() {
									
									//Carga las operaciones al seleccionar modelo
									$.getJSON("../getsJSON/get_operaciones_xModelo_reg.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="Default">- - - Selecciona Una Operacion - - -</option>\n';
										if (j[0] == '') {

										} else {
											for (var i = 0; i < j.length; i++) {				
												options += '<option value="'+ j[i].Operacion +'">'+ j[i].Operacion +'</option> \n';
											}
										}

										$("#operacionesReg").html(options);
									});

									//Carga los codigos al seleccionar un modelo.
									$.getJSON("../getsJSON/get_codigos_reg.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="Default">- - - Selecciona Un Codigo - - -</option>\n';
										if (j[0] == '') {

										} else {
											for (var i = 0; i < j.length; i++) {				
												options += '<option value="'+ j[i].Codigo +'">'+ j[i].Codigo +'</option> \n';
											}
										}

										$(".selectCodigo").html(options);

									});


									//Carga los componentes al seleccionar un modelo.
									$.getJSON("../getsJSON/get_componentes.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="Default">- - - Selecciona Un Componente - - -</option>\n';
										if (j[0] == '') {

										} else {
											for (var i = 0; i < j.length; i++) {				
												options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';
											}
										}

										$(".selectComponente").html(options);
										
									});

								});
							});
          				</script>

          				<!-- MODELOS -->
          				<label for="familia"><b>Modelos</b></label>
						<div class="ui-field-contain" id="divModelo_Reg" title="Modelos">
            				<select id="modelosReg">
            					<option value="Default">- - - Selecciona Un Modelo - - -</option>
							</select>
          				</div>

          				<!-- OPERACIONES -->
          				<label for="operacion"><b>Operacion</b></label>
          				<div class="ui-field-contain" id="divOperacion_Reg" title="Operaciones">
            				<select id="operacionesReg">
            					<option value="Default">- - - Selecciona Una Operacion - - -</option>
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

				<center>

					<script type="text/javascript">
						$(document).ready(function() {
							$('#guardar').click(function() {
								var fecha = document.getElementById('fecha').value;
								var turno = document.getElementById('turno').value;
								var linea = document.getElementById('linea').value;
								var familia = document.getElementById('familias').value;
								var modelo = document.getElementById('modelosReg').value;
								var operacion = document.getElementById('operacionesReg').value;
								var empleado = document.getElementById('empleado').value;
								var produccion = document.getElementById('produccion').value;
								var piezas = document.getElementById('piezas').value;
								var codigo = document.getElementById('select_codigos1').value;
								var componente = document.getElementById('select_comp1').value;
								var cantidad = document.getElementById('cantidad1').value;

								alert('Fecha: '+ fecha +'\nTurno: '+ turno +'\nLinea: '+ linea +'\nFamilia: '+ familia +'\nModelo: '+ modelo +'\nOperacion: '+ operacion +'\nEmpleado: '+ empleado +'\nProduccion: '+ produccion +'\nPiezas: ' + piezas);

								if (fecha==''||linea=='Default'||familia=='Default'||modelo=='Default'||operacion=='Default'||empleado==''||produccion==''||piezas=='') {
									alert('Debes llenar todos los campos');
								} else {

									$.getJSON("../getsJSON/set_registros.php", {ajax: true, fecha: fecha, turno: turno, linea: linea, familia: familia, modelo: modelo, operacion: operacion, empleado: empleado, produccion: produccion, piezas: piezas, codigo: codigo, componente: componente, cantidad: cantidad, area: <?php echo "'$area'"; ?>}, function(j) {
										if (j[0] == 'exito') {
											alert('Se ingresaron los datos correctamente.');
										} else if (j[0] == 'error') {
											alert('Problema al insertar los datos.');
										};
										
									});
								}
							});
						});
					</script>

					<a href="" data-role="button" id="guardar" data-icon="check" data-inline="true">Guardar</a>

					<script type="text/javascript">

						$(document).ready(function() {

							//Agregar Operacion
							$(function() {
								var k = 0;
								var opcCode = '';
								var opcComp = '';
								$("#agregarRegistro").on('click', function(){
									k++;
									modelo = document.getElementById('modelosReg').value;
									
									//$("#tabla_Reg tbody tr:eq(0)").clone().removeClass('fila-base').appendTo("#tabla_Reg tbody");
									$('#tabla_Reg > tbody:last-child').append('<tr><td class="tdCodigos"><select class="selectCodigo" id="select_codigos'+k+'"><option value="Default">- - - Selecciona Un Codigo - - -</option></select></td><td class="tdComponentes"><select class="selectComponente" id="select_comp'+k+'" ><option value="Default">- - - Selecciona Un Componente - - -</option></select></td><td class="tdCantidad"><input class="inputCantidad" id="cantidad'+k+'" type="number" min="0" max="99999" size="5"></td><td class="eliminar">Eliminar</td></tr>');


										$.getJSON("../getsJSON/get_codigos_reg.php", {ajax: true, modelo: modelo, area: <?php echo "'$area'"; ?>}, function(j) {
											var options = '<option value="Default">- - - Selecciona Un Codigo - - -</option>\n';
											//opcCode = $(this).children('select').prop('id');
											if (j[0] == '') {

											} else {
												for (var i = 0; i < j.length; i++) {				
													options += '<option value="'+ j[i].Codigo +'">'+ j[i].Codigo +'</option> \n';
												}
											}

											$('#select_codigos'+k+'').html(options);
										});

										$.getJSON("../getsJSON/get_componentes.php", {ajax: true, modelo: modelo, area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="Default">- - - Selecciona Un Componente - - -</option>\n';
										if (j[0] == '') {

										} else {
											for (var i = 0; i < j.length; i++) {				
												options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';
											}
										}

										$('#select_comp'+k+'').html(options);
										
									});

								});

								$(document).on("click", ".eliminar", function(){
									var parent = $(this).parents().get(0);
									$(parent).remove();
								});
								//$('.selectCodigo').selectmenu("refresh");
								//$('.selectComponente').selectmenu("refresh");
							});

						});
					</script>

					<a id="agregarRegistro" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>

					<script type="text/javascript">	
						$(document).ready(function(){

							$('#limpiar').click(function(){

								window.location.reload();

							});
						});
					</script>

					<input type="button" id="limpiar" name="limpiar" data-icon="refresh" data-inline="true" value="Limpiar">
					
				</center><br>
				
				<!-- Tabla -->
				<center>
					<div id="divTabla_Reg">
						<table id="tabla_Reg" cellpadding="0" cellspacing="0" border="0" class="display">
							<thead>
								<tr>
									<th width="60" align="left">Codigo</th>
									<th width="280" align="left">Componente</th>
									<th width="130" align="left">Cantidad</th>
									<th width="130" align="left">Eliminar</th>
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