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
		#subsecsectA_CD {
			margin-left: -35%;
			width: 50%;
		}

		#divTabla_CDD {
			margin-left: -10%;
			width: 140%;
			max-height: 500px;
			overflow: auto;
		}

		#divCodigos_CDD, #divOperaciones_CDD, #divModelo_CDD, #divFechaFinal_CDD, #divComponente_CDD,
		#divFamilia_CDD, #divFechaInicial_CDD, #divSelectLinea_CDD { width: 100%; }
	}
</style>
<body>
	<?php
		function cargaFamilias($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Familias FROM familias ORDER BY Familias");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Familias']."'>".$row['Familias']."</option>";
			}
			mysqli_close($con);
		}

		function cargaModelos($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Modelo FROM modelos ORDER BY Modelo");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Modelo']."'>".$row['Modelo']."</option>";
			}
			mysqli_close($con);
		}

		function cargaOperaciones($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Operacion FROM operaciones ORDER BY Operacion");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Operacion']."'>".$row['Operacion']."</option>";
			}
			mysqli_close($con);
		}

		function cargaCodigos($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Codigo FROM codigos ORDER BY Codigo");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Codigo']."'>".$row['Codigo']."</option>";
			}
			mysqli_close($con);
		}

		function cargaComponentes($conn, $database) {
			//echo "<script>alert('".$database."');</script>";
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Comp FROM componentes ORDER BY Comp");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Comp']."'>".$row['Comp']."</option>";
			}
			mysqli_close($con);
		}
	?>
	<div data-role="page" data-theme="b" class="ui-responsive-panel">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Correccion De Datos<br>Correction Of Data
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
		<center>

			<div id="divForm_CDD">

				<form action="">

					<div class="ui-grid-a">

						<div class="ui-block-a" id="sectA_CD">

							<div class="ui-grid-a" id="subsecsectA_CD">

								<div class="ui-block-a">

									<label for="fecha"><b>Fecha Inicial</b></label>
									<div class="ui-field-contain" id="divFechaInicial_CDD" title="Fecha Inicial">
			            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
			          				</div>

			          				<script type="text/javascript">
										$(function() {
											$("select#familias").change(function() {
												
												//Carga los modelos al seleccionar una familia.
												$.getJSON("../getsJSON/get_modelos_repo.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
													var options = '<option value="default">- - - Todos - - -</option>\n';

													for (var i = 0; i < j.length; i++) {				
														options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
													}
													$("select#modelos").html(options);
												});

												//Carga las operaciones al seleccionar una familia.
												$.getJSON("../getsJSON/get_operaciones_repo.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
													var options = '<option value="default">- - - Todos - - -</option>\n';

													for (var i = 0; i < j.length; i++) {				
														options += '<option value="'+ j[i].Operacion +'">'+ j[i].Operacion +'</option> \n';
													}
													$("select#operaciones").html(options);
												});

											});
											
										});

										$(document).ready(function(e) {
											$("select#familias").change();
										});
									</script>

			          				<label for="familias"><b>Familias</b></label>
			          				<div class="ui-field-contain" id="divFamilia_CDD">
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

			          				<script type="text/javascript">
										$(function() {
											$("select#modelos").change(function() {

												//Carga las operaciones al seleccionar un modelo.
												$.getJSON("../getsJSON/get_operaciones_repo_xModelo.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
													var options = '<option value="default">- - - Todos - - -</option>\n';

													for (var i = 0; i < j.length; i++) {				
														options += '<option value="'+ j[i].Operacion +'">'+ j[i].Operacion +'</option> \n';
													}
													$("select#operaciones").html(options);
												});

												//Carga los codigos al seleccionar un modelo.
												$.getJSON("../getsJSON/get_codigos_repo.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
													var options = '<option value="default">- - - Todos - - -</option>\n';

													for (var i = 0; i < j.length; i++) {				
														options += '<option value="'+ j[i].Codigo +'">'+ j[i].Codigo +'</option> \n';
													}
													$("select#codigos").html(options);
												});

												//Carga los componentes al seleccionar una modelo.
												$.getJSON("../getsJSON/get_componentes_repo.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
													var options = '<option value="default">- - - Todos - - -</option>\n';

													for (var i = 0; i < j.length; i++) {				
														options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';
													}
													$("select#componentes").html(options);
												});

											});
											
										});

										$(document).ready(function(e) {
											$("select#modelos").change();
										});
									</script>

			          				<label for="modelos"><b>Modelos</b></label>
			          				<div class="ui-field-contain" id="divModelo_CDD">
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
										</select>
			          				</div>

			          				<label for="operaciones"><b>Operaciones</b></label>
			          				<div class="ui-field-contain" id="divOperaciones_CDD">
			          					<select name="operaciones" id="operaciones">
											<option value="default">- - - Todas - - -</option>
											<?php
												if ($area == 'Electronica') {
													cargaOperaciones($con, 'Electronica');
												} elseif ($area == 'Electromecanicos') {
													cargaOperaciones($con, 'Electromecanicos');
												} elseif ($area == 'Valvulas') {
													cargaOperaciones($con, 'Valvulas');
												}
											?>
										</select>
			          				</div>

								</div>

								<div class="ui-block-b">

									<label for="fecha"><b>Fecha Final</b></label>
									<div class="ui-field-contain" id="divFechaFinal_CDD" title="Fecha Final">
			            				<input name="fechaFinal" id="fechaFinal" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
			          				</div>

			          				<label for="codigos"><b>Codigos</b></label>
									<div class="ui-field-contain" id="divCodigos_CDD">
			          					<select name="codigos" id="codigos">
											<option value="default">- - - Todos - - -</option>
											<?php
												if ($area == 'Electronica') {
													cargaCodigos($con, 'Electronica');
												} elseif ($area == 'Electromecanicos') {
													cargaCodigos($con, 'Electromecanicos');
												} elseif ($area == 'Valvulas') {
													cargaCodigos($con, 'Valvulas');
												}
											?>
										</select>
			          				</div>

			          				<label for="componentes"><b>Componentes</b></label>
			          				<div class="ui-field-contain" id="divComponente_CDD">
			          					<select name="componentes" id="componentes">
											<option value="default">- - - Todos - - -</option>
											<?php
												if ($area == 'Electronica') {
													cargaComponentes($con, 'Electronica');
												} elseif ($area == 'Electromecanicos') {
													cargaComponentes($con, 'Electromecanicos');
												} elseif ($area == 'Valvulas') {
													cargaComponentes($con, 'Valvulas');
												}
											?>
										</select>
			          				</div>

			          				<label for="linea"><b>Linea</b></label>
			          				<div class="ui-field-contain" id="divSelectLinea_CDD">
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

			          				<label for=""><b>Turno</b></label>
			          				<div class="ui-field-contain">
			          					<select name="turno" id="turno " data-role="slider" data-theme="b" data-track-theme="b">
			                				<option value="1">1</option>
			                				<option value="3">3</option>
			        					</select>
			          				</div>

								</div>

							</div>

						</div>

						<div class="ui-block-b" id="sectB_CD">

							<div class="ui-field-contain">

								<script type="text/javascript">
									$(document).ready(function(){
										$('#btnLimpiar').click(function(){
											$('#tr_data').remove();
											document.getElementById('fechaInicial').value='';
											document.getElementById('fechaFinal').value='';
										});
									});
								</script>

								<center>
									<a href="" id="btnMostrar" data-role="button" data-inline="true" data-icon="eye">Mostar</a>
									<a href="" id="btnLimpiar" data-role="button" data-inline="true" data-icon="refresh">Limpiar</a>
								</center>

							</div>

							<center>

								<div id="divTabla_CDD">

									<table id="tabla_CDD" cellpadding="0" cellspacing="0" border="0" class="display">
										<thead>
											<tr>
												<th align="left">Fecha</th>
												<th align="left">Turno</th>
												<th align="left">Linea</th>
												<th align="left">Empleado</th>
												<th align="left">Modelo</th>
												<th align="left">Operacion</th>
												<th align="left">Cantidad</th>
												<th align="left">Codigo</th>
												<th align="left">Componente</th>
												<th align="left">Produccion</th>
												<th align="left">Familia</th>
											</tr>
										</thead>
										<tbody>
											<tr id="tr_data">
												<td><span>8/01/2016</span></td>
												<td><span>1</span></td>
												<td><span>5</span></td>
												<td><span>51168</span></td>
												<td><span>11E79 101B1</span></td>
												<td><span>Acalidad</span></td>
												<td><span>7</span></td>
												<td><span>1000</span></td>
												<td><span>06</span></td>
												<td><span>54</span></td>
												<td><span>11E79</span></td>
											</tr>
										</tbody>
									</table>

								</div>

							</center>

						</div>

					</div>

				</form>
			
			</div>

		</center>

	</div>
</body>
</html>