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
											<option value="default">- - - Todas - - -</option>
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
														var options = '<option value="default">- - - Selecciona Un Modelo - - -</option>\n';

														for (var i = 0; i < j.length; i++) {				
															options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
														}
														$("select#modelos").html(options);
													});

													//CARGA OPERACIONES AL SELECCIONAR FAMILIA
													$.getJSON("../getsJSON/get_operaciones_xFamilia_desem.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
														var tr = "";
														for (var i = 0; i < j.length; i++) {

															tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
															
															tr += '<td><span id="' + j[i].Operacion + '"><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' + j[i].Operacion + '<a></span></td><td><span class="ui-btn" id="' + j[i].Descripcion + '">' + j[i].Descripcion + '</span></td>';

															if (j[i].UsarPPms == 1) {
																tr += '<td><fieldset data-iconpos="left" ><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox" checked><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
															} else {
																tr += '<td><fieldset data-iconpos="left" ><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox"><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
															}

															tr += '<td><select name="' + j[i].Grupo + '" id="' + j[i].Grupo + '" ><option value="default" >- - - - - - -</option><option value="' + j[i].Grupo + '" selected>' + j[i].Grupo + '</option><option value="final_test">Final Test</option><option value="qc_audit">QC Audit</option><option value="process">Process</option></select></td></tr>';
														}
														$("tbody#content_operaciones").html(tr);
													});
												});
				          					});	
				          				</script>

				          				<label for="modelos"><b>Modelo</b></label>
				          				<select name="modelos" id="modelos">
											<option value="default">- - - Todos - - -</option>
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
												$('#tr_data').remove();
												document.getElementById('fechaInicial').value='';
												document.getElementById('fechaFinal').value='';
												document.getElementById('producidas').value='';
												document.getElementById('rechazadas').value='';
												document.getElementById('ppms').value='';
												document.getElementById('rty').value='';
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

								<div class="ui-block-c">
									<a href="" data-role="button" id="btnExcel" data-icon="grid" data-inline="true">Excel</a>
								</div>

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
											<tbody>
												<!--Primer Dato (Para el 2do hay que cambiar el id y el for)-->
												<tr id="tr_data">
													<td><span>Acalidad</span></td>
													<td><span>0</span></td>
													<td><span>0</span></td>
													<td><span>0%</span></td>
													<td><span>0</span></td>
													<td><span>100%</span></td>
												</tr>
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