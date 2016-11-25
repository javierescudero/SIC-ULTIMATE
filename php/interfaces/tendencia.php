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
		#divFlipDatos_Tend {
			margin-left: 65%;
		}

		#fieldSetBtns_Tend {
			margin-left: 35%;
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
			<h1>Graficas De Tendencia<br>Trend Graphs
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
		<div id="divForm_Tend">

			<form action="">
				<div class="ui-grid-a">

					<div class="ui-block-a" id="sectA_tend">

						<div class="ui-grid-a" id="subsectA_tend">

							<div class="ui-block-a">

								<label for="fecha"><b>Fecha Inicial</b></label>
								<div class="ui-field-contain" id="divFecha" title="Fecha Inicial">
		            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
		          				</div>

		          				<div id="selectFamilia_Tend">
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
		          				</div>

							</div>

							<div class="ui-block-b">

								<label for="fecha"><b>Fecha Final</b></label>
								<div class="ui-field-contain" id="divFecha" title="Fecha Final">
		            				<input name="fechaFinal" id="fechaFinal" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
		          				</div>

		          				<div id="selectModelo_Tend">

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

		          					<label for="modelos"><b>Modelos</b></label>
		          					<select name="modelos" id="modelos">
										<option value="default">- - - Todos - - -</option>
									</select>

		          				</div><br><br>

							</div>

						</div>

					</div>

					<div class="ui-block-b" id="sectB_tend">

						<div class="containing-element" id="divFlipDatos_Tend">
								
							<label for="flipDatos_Tend" id="lblMostrar_Tend"><b>Mostrar Datos</b></label>
							<select name="flipDatos_Tend" id="flipDatos_Tend" data-role="slider">
								<option value="0">Acumulados</option>
								<option value="1">Diarios</option>
							</select>

						</div>

						<fieldset data-role="controlgroup" id="fieldSetBtns_Tend">
							
							<script type="text/javascript">
								$(document).ready(function(){
									$('#btnLimpiar').click(function(){
										$('#tr_data').remove();
										document.getElementById('fechaInicial').value='';
										document.getElementById('fechaFinal').value='';
									});
								});
							</script>

							<a href="" data-role="button" id="btnCalcular" data-icon="check" data-inline="true">Calcular</a>
							<a href="" data-role="button" id="btnLimpiar" data-icon="refresh" data-inline="true">Limpiar</a>

						</fieldset>
						
						<div id="divTabla_Tend">

							<table id="tabla_Tend" cellpadding="0" cellspacing="0" border="0" class="display">
								<thead>
									<tr>
										<th width="110">Selec</th>
										<th width="500">Operacion</th>
									</tr>
								</thead>
								<tbody>
									<tr id="tr_data">
										<td id="colSeleccion_Tend">
											<fieldset data-iconpos="right" id="fieldSeleccion">
												<label for="seleccion">Sel.</label>
												<input id="seleccion" name="seleccion" type="checkbox">
		  									</fieldset></td>
										<td id="colOperacion"><span>Acalidad</span></td>
									</tr>
								</tbody>
							</table>

						</div>

					</div>

				</div>
	
			</form>
	</div>
</body>
</html>