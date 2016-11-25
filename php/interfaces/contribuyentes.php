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
		#divCodigos_contr, #divComponentes_contr { width: 60%; }
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

		function cargaModelos($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT Modelo FROM modelos ORDER BY Modelo");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Modelo']."'>".$row['Modelo']."</option>";
			}
			mysqli_close($con);
		}
	?>
	<div data-role="page" data-theme="b" class="ui-responsive-panel">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Contribuyentes<br>Quality Contributors
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
		<div id="divForm_Cont">
			<form action="">
				<center>

					<div class="ui-grid-a">

						<div class="ui-block-a">

							<div class="ui-grid-a" id="sectA_contr">

								<div class="ui-block-a">

									<label for="fecha"><b>Fecha Inicial</b></label>
									<div class="ui-field-contain" id="divFecha" title="Fecha Inicial">
			            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
			          				</div>

			          				<div id="selectFamilia_Cont">

			          					<label for="familias"><b>Familias</b></label>
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

			          				</div><br>

			          				<label for="mostrar"><b>Mostrar top codigos</b></label>
			          				<div class="ui-field-contain" id="divCodigos_contr">
			          					<input type="number" id="codigos" min="0">
			          				</div>

								</div>

								<div class="ui-block-b">

									<label for="fecha"><b>Fecha Final</b></label>
									<div class="ui-field-contain" id="divFecha" title="Fecha Final">
			            				<input name="fechaFinal" id="fechaFinal" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
			          				</div>

			          				<div id="selectModelo_Cont">

			          					<label for="modelos"><b>Modelos</b></label>
			          					<select name="modelos" id="modelos">
											<option value="default">- - - Todos - - -</option>
											<?php
												if ($area == 'Electronica') {
													cargaModelos($con, 'Electronica');
												} elseif ($area == 'Electromecanicos') {
													cargaModelos($con, 'Electromecanicos');
												} elseif ($area == 'Valvulas') {
													cargaModelos($con, 'Valvulas');
												}
											?>

											<script type="text/javascript">
					          					$(function() {
													$('select#familias').change(function(){

														//CARGA MODELOS AL SELECIONAR FAMILIA
														$.getJSON("../getsJSON/get_modelos_repo.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
															var options = '<option value="default">- - - Todos - - -</option>\n';

															for (var i = 0; i < j.length; i++) {				
																options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
															}
															$("select#modelos").html(options);
														});
													});
					          					});	
					          				</script>

										</select>

			          				</div><br>

			          				<label for="cantidad"><b>Componentes</b></label>
			          				<div class="ui-field-contain" id="divComponentes_contr" data-role"inline">
			          					<input type="number" id="cantComponentes_Tend" min="0">
			          				</div>

								</div>

							</div>

						</div>

						<div class="ui-block-b" id="secB_contr">

							<fieldset data-role="controlgroup" id="fieldSetBtns_Cont">

								<center>

									<script type="text/javascript">
										$(document).ready(function(){
											$('#btnLimpiar').click(function(){
												$('#tr_data').remove();
												document.getElementById('fechaInicial').value='';
												document.getElementById('fechaFinal').value='';
												document.getElementById('codigos').value='';
												document.getElementById('cantComponentes_Tend').value='';
												document.getElementById('ppms').value='';
												document.getElementById('rty').value='';
											});
										});
									</script>

									<a href="" data-role="button" id="btnCalcular" data-icon="check" data-inline="true">Calcular</a>
									<a href="" data-role="button" id="btnLimpiar" data-icon="refresh" data-inline="true">Limpiar</a>

								</center>

							</fieldset><br><br>

							<div id="divTablaCont">

								<center>

									<table id="tabla_Cont" cellpadding="0" cellspacing="0" border="0" class="display">
										<thead>
											<tr>
												<th width="110">Selec</th>
												<th width="500">Operacion</th>
											</tr>
										</thead>
										<tbody>
											<tr id="tr_data">
												<td id="colSeleccion_Cont"><fieldset data-iconpos="right" id="fieldSeleccion">
														<label for="seleccion">Sel.</label>
														<input id="seleccion" name="seleccion" type="checkbox">
						      						</fieldset></td>
												<td id="colOperacion"><span>Acalidad</span></td>
											</tr>
										</tbody>
									</table>

								</center>

							</div>

						</div>

					</div>

				</center>

			</form>

		</div>

	</div>
</body>
</html>