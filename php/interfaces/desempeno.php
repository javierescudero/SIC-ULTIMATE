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

	<script src="../../js/highcharts/highcharts.js"></script>
	<script src="../../js/highcharts/highcharts-3d.js"></script>
	<script src="../../js/highcharts/dark-unica.js"></script>
	<script src="../../js/highcharts/exporting.js"></script>

</head>
<style type="text/css">
	@media screen and (min-width: 480px) {

	}
	@media screen and (max-width: 1800px) {
		#sectA {
			width: 25%;
			margin-left: 5%;
		}

		#sectB {
			width: 90%;
			margin-left: -20%;
		}
	}
</style>
<body>
	<?php
		function cargaFamilias($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT Familias FROM familias ORDER BY Familias");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Familias']."'>".$row['Familias']."</option>";
			}
			mysqli_close($con);
		}
	?>
	<div data-role="page" data-theme="b" class="ui-responsive-panel">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Desempeño Del Producto<br>Product Performance
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

		<!-- Formulario -->
		<div id="divForm_Des">
			<center>
				<form action="">
					<div class="ui-grid-a">
						<div class="ui-block-a" id="sectA">

							<div class="ui-grid-a">

								<div class="ui-block-a">
									<label for="fecha"><b>Fecha Inicial</b></label>
									<div class="ui-field-contain" id="divFecha" title="Fecha Inicial">
			            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
			          				</div>
			          				<div id="selectFamilia_Des">
			          					<label for="familias"><b>Familia</b></label>
			          					<select name="familias" id="familias">
											<option value="Default">- - - Todas - - -</option>
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
								</div>

								<div class="ui-block-b">
									<label for="fecha"><b>Fecha Final</b></label>
									<div class="ui-field-contain" id="divFecha" title="Fecha Final">
				            			<input name="fechaFinal" id="fechaFinal" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
				          			</div>
				          			<div id="selectModelo_Des">

				          				<script type="text/javascript">
				          					$(function() {
												$('select#familias').change(function(){

													//CARGA MODELOS AL SELECIONAR FAMILIA
													$.getJSON("../getsJSON/get_modelos_repo.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
														var options = '<option value="Default">- - - Selecciona Un Modelo - - -</option>\n';

														for (var i = 0; i < j.length; i++) {				
															options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
														}
														$("select#modelos").html(options);
													});

												});
				          					});	
				          				</script>

				          				<label for="modelos"><b>Modelo</b></label>
				          				<select name="modelos" id="modelos">
											<option value="Default">- - - Todos - - -</option>
										</select>
				          			</div><br>
								</div>
							</div>

							<!-- BOTONES -->
							<fieldset data-role="controlgroup" id="fieldSetGrpBtns_Des">
								<center>

									<script type="text/javascript">
										$(document).ready(function(){
											$('#btnLimpiar').click(function(){
												$('#content_data tr').remove();
												document.getElementById('fechaInicial').value='';
												document.getElementById('fechaFinal').value='';
												document.getElementById('producidas').value='';
												document.getElementById('rechazadas').value='';
												document.getElementById('ppms').value='';
												document.getElementById('rty').value='';
												$('#familias').val('Default').attr('selected', true).selectmenu("refresh");
												$('#modelos').val('Default').attr('selected', true).selectmenu("refresh");
											});

											$('#btnCalcular').click(function() {
												var fechainicial = document.getElementById('fechaInicial').value;
												var fechafinal = document.getElementById('fechaFinal').value;
												var familia = document.getElementById('familias').value;
												var modelo = document.getElementById('modelos').value;
												//alert('F. Inicial: ' +fechainicial+ '\nF. Final: ' +fechafinal+ '\nFamilia: ' +familia+ '\nModelo: ' +modelo);
												if (familia=='Default'||modelo=='Default'||fechainicial==''||fechafinal=='') {
													alert('Debes llenar todos los campos');
												} else {

													$.getJSON("../getsJSON/calc_desempeno.php", {ajax: true, fechainicial: fechainicial, fechafinal: fechafinal, familia: familia, modelo: modelo, area: <?php echo "'$area'"; ?>}, function(j) {
														var tr = '';
														
														var pzProducidas = 0;
														var pzRechazdas = 0;
														var totalppms = 0;
														var produccion;
														var rechazos;
														var pRechazos;
														var ppms;
														var fty;
														var auxfty = 0;
														var auxrty = 1;
														for (var i = 0; i < j.length; i++) {
															
															//Produccion
															if (j[i].prod == null) { produccion = 0; }
															else { produccion = j[i].prod; }

															//Rechazos
															if (j[i].rech == null) { rechazos = 0; }
															else { rechazos = j[i].rech; }

															//% Rechazos
															pRechazos = (rechazos/produccion)*100;
															
															//PPMs
															if (isNaN(pRechazos)) { pRechazos = 0; }
															else { pRechazos = pRechazos.toFixed(2); }

															ppms = (rechazos/produccion)*1000000;

															if (isNaN(ppms)) { ppms = 0; }
															else { ppms = ppms.toFixed(); }

															//FTY
															fty = 100 - (rechazos/produccion)*100;

															if (isNaN(fty)) { 
																fty = 100;
															}
															else { 
																fty = fty;
															}

															//Piezas Producidas Totales
															if (j[i].usarppms == 1) {

																if (j[i].prod == null) { pzProducidas = parseInt(pzProducidas + 0); }
																else { pzProducidas = parseInt(pzProducidas + parseInt(j[i].prod)); }

															} else {}

															//Piezas Rechazadas Totales
															if (j[i].usarppms == 1) {

																if (j[i].prod == null) { pzRechazdas = parseInt(pzRechazdas + 0); }
																else { pzRechazdas = parseInt(pzRechazdas + parseInt(j[i].rech)); }

															} else {}

															//PPMs Total
															totalppms = (pzRechazdas/pzProducidas)*1000000;

															//RTY Total
															if (j[i].usarppms == 1) {
																auxfty = parseFloat(fty)/100;
																auxrty = parseFloat(auxrty)*parseFloat(auxfty);
																rty = parseFloat(auxrty.toFixed(4))*100;
															} else {}

															tr += '<tr><td><span>'+j[i].operacion+'-'+j[i].descripcion+'</span></td>';
															tr += '<td><span>'+produccion+'</span></td>';
															tr += '<td><span>'+rechazos+'</span></td>';
															tr += '<td><span>'+pRechazos+'%</span></td>';
															tr += '<td><span>'+ppms+'</span></td>';
															tr += '<td><span>'+fty.toFixed(2)+'%</span></td></tr>';

															$('#producidas').val(pzProducidas);
															$('#rechazadas').val(pzRechazdas);
															$('#ppms').val(totalppms.toFixed());
															$('#rty').val(rty + '%');
															
														}

														$("#content_data").html(tr);
													});

												}

											});
										});
									</script>

									<a href="" data-role="button" id="btnCalcular" data-icon="check" data-inline="true">Calcular</a>
									<a href="" data-role="button" id="btnLimpiar" data-icon="refresh" data-inline="true">Limpiar</a>
								</center>
							</fieldset>

						</div>

						<div class="ui-block-b" id="sectB">
							<div class="ui-grid-b">
								<div class="ui-block-a">
									<label for="producidas"><b>Piezas Producidas</b></label>
									<input name="producidas" id="producidas" type="text" disabled/>
									<label for="rechazadas"><b>Piezas Rechazadas</b></label>
									<input name="rechazadas" id="rechazadas" type="text" disabled/>
								</div>

								<div class="ui-block-b">
									<label for="ppms"><b>PPMs</b></label>
									<input name="ppms" id="ppms" type="text" disabled>
									<label for="rty"><b>RTY</b></label>
									<input name="rty" id="rty" type="text" disabled>
								</div>

								<!--<div class="ui-block-c">
									<a href="" data-role="button" id="btnExcel" data-icon="grid" data-inline="true">Excel</a>
								</div>-->

								<center>
									<div id="divTabla_Des">
										<table id="tabla_Des" cellpadding="0" cellspacing="0" border="0" class="display">
											<thead>
												<tr>
													<th width="280" align="left">Operacion</th>
													<th width="100" align="left">Produccion</th>
													<th width="100" align="left">Rezhazos</th>
													<th width="100" align="left">% Rezhazos</th>
													<th width="100" align="left">PPMs</th>
													<th width="100" align="left">FTY</th>
												</tr>
											</thead>
											<tbody id="content_data">
											</tbody>
										</table>
									</div>
								</center><br>

							</div>
						</div>
					</div>
				</form>
			</center>
			
		</div>
	</div>
</body>
</html>