<?php
	require_once("../../../php/conexion.php");
	if (isset($_GET['area'])) {
		$area = $_GET['area'];
	}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<title>SIC Ultimate</title>

	<script src="../../../js/jquery-1.12.4.min.js"></script>
	<script src="../../../js/jquery.mobile-1.4.5.js"></script>
	<script src="../../../js/js_refresh.js"></script>
	
	<link rel="stylesheet" href="../../../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../../../css/css_style.css">
</head>
<body>
	<?php
		function cargaFamilias($conn, $database) {
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Familias FROM familias ORDER BY Familias");

			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Familias']."'>".$row['Familias']."</option>";
			}
			mysqli_close($con);
		}
	?>
	<div data-role="page" data-theme="b" id="divPage">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>SIC Ultimate<br>
			</h1>
		</div>
		<?php
			include("menu.php");
		?>
		<div id="divForm_FM">
			<form action="">
				<div class="ui-grid-c">
					<div class="ui-block-a">
						<div id="divListas">

							<script type="text/javascript">
								var flag = true;
								$(function() {
									$("select#familias").change(function() {
										//Carga los modelos al seleccionar una familia.
										var loadMod = $("select#modelos");
										$.getJSON("../../../php/get_modelos.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
											var options = "";
											for (var i = 0; i < j.length; i++) {												
												options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
											}
											$("select#modelos").html(options);

											if (flag == true) {
												loadMod.selectmenu("refresh", true);
											}
											flag == true;
										});

										//Carga las operaciones al seleccionar una familia.
										var loadOp = $("table#tablaOperaciones");
										$.getJSON("../../../php/get_operaciones_xFamilia.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
											var tr = "";
											for (var i = 0; i < j.length; i++) {
												
												tr += '<tr><td><span id="' + j[i].Operacion + '">' + j[i].Operacion + '</span></td><td><span id="' + j[i].Descripcion + '">' + j[i].Operacion + '</span></td>';

												if (j[i].UsarPPms == 1) {
													tr += '<td><fieldset data-iconpos="left"><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox" checked><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td><td>';
												} else {
													tr += '<td><fieldset data-iconpos="left"><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox"><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td><td>';
												}

												tr += '<td><select name="' + j[i].Grupo + '" id="' + j[i].Grupo + '" ><option value="default" >- - - - - - -</option><option value="' + j[i].Grupo + '" selected>' + j[i].Grupo + '</option><option value="final_test">Final Test</option><option value="qc_audit">QC Audit</option><option value="process">Process</option></select></td></tr>';
											}
											$("tbody#content_operaciones").html(tr);

											if (flag == true) {
												loadOp.selectmenu("refresh", true);
											}
											flag == true;
										});

									});

									$("select#modelos").change(function() {
										//Carga las operaciones al seleccionar un modelo.
										var loadOp2 = $("table#tablaOperaciones");
										$.getJSON("../../../php/get_operaciones_xModelo.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
											var tr = "";
											for (var i = 0; i < j.length; i++) {
												
												tr += '<tr><td><span id="'+j[i].Operacion+'" >' +j[i].Operacion+ '</span></td><td><span id="'+j[i].Descripcion+'" >' +j[i].Operacion+ '</span></td>';

												if (j[i].UsarPPms == 1) {
													tr += '<td><fieldset data-iconpos="left"><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" checked><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												} else {
													tr += '<td><fieldset data-iconpos="left"><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox"><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												}

												tr += '<td><select name="'+j[i].Grupo+'" id="'+j[i].Grupo+'" ><option value="default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="final_test">Final Test</option><option value="qc_audit">QC Audit</option><option value="process">Process</option></select></td></tr>';
											}
											$("tbody#content_operaciones").html(tr);

											if (flag == true) {
												loadOp2.selectmenu("refresh", true);
											}
											flag == true;
										});
									});

								});

								$(document).ready(function(e) {
									flag = false;	
									$("select#familias").change();
								});
							</script>

							<center><label for="divFamilia_FM" id="lblFamilia" data-theme="c"><b>Familias</b></label></center>
							<select name="familias" id="familias">
								<option>- - - Selecciona una familia - - -</option>
								<?php
									if ($area == 'electronica') {
										cargaFamilias($con, 'electronica');
									} elseif ($area == 'electromecanicos') {
										cargaFamilias($con, 'electromecanicos');
									} elseif ($area == 'valvulas') {
										cargaFamilias($con, 'valvulas');
									}
								?>
							</select>

							<center>

								<script type="text/javascript">
									$(function() {

										/*$("a#agregarFamilia").click(function() {
											var addFam = $("table#tablaOperaciones");
										});*/

									});
								</script>

								<!-- PopUp Agregar Familia-->
								<div data-role="main" class="ui-content">
			    					<a href="#popupAgregarFamilia" id="btnAgregarFam" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
			    					<div data-role="popup" id="popupAgregarFamilia" class="ui-content">
			      						<h3>Agregar Familia</h3>
			      						<input type="text" id="pop_inputAgregaFamilia" placeholder="Familia...">
			      						<center>
											<a id="agregarFamilia" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
											<a id="cancelarAgregarFamilia" href="" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
										</center>
			    					</div>
			  					</div>

			  					<!-- PopUp Elimnar Familia-->
			  					<div data-role="main" class="ui-content">
			    					<a href="#popupEliminarFamilia" id="btnAgregarFam" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
			    					<div data-role="popup" id="popupEliminarFamilia" class="ui-content">
			      						<h3>Eliminar Familia</h3>
			      						<p>Estas seguro de eliminar esta <b>Familia</b>???<br>
			      							Esta familia contiene modelos.</p>
			      						<center>
											<a id="eliminarFamilia" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
											<a id="salir" href="" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
										</center>
			    					</div>
			  					</div><br><br><br><br>
							</center>

							<center><label for="divModelos_FM" id="lblModelos" data-theme="c"><b>Modelos</b></label></center>
							<select name="modelos" id="modelos">
								<option>- - - Selecciona un modelo - - -</option>
							</select>

							<center>
								<!-- PopUp Agregar Modelo-->
								<div data-role="main" class="ui-content">
			    					<a href="#popupAgregarModelo" id="btnAgregarMod" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
			    					<div data-role="popup" id="popupAgregarModelo" class="ui-content">
			      						<h3>Agregar Modelo</h3>
			      						<input type="text" id="pop_inputAgregaModelo_FM" placeholder="Modelo...">
			      						<center>
											<a id="agregarMod" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
											<a id="cancelarAgregarModelo" href="" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
										</center>
			    					</div>
			  					</div>

			  					<!-- PopUp Elimnar Modelo-->
			  					<div data-role="main" class="ui-content">
			    					<a href="#popupEliminarModelo" id="btnAgregarMod" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
			    					<div data-role="popup" id="popupEliminarModelo" class="ui-content">
			      						<h3>Eliminar Modelo</h3>
			      						<p>Estas seguro de eliminar este <b>Modelo</b>???</p>
			      						<center>
											<a id="eliminarModelo" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
											<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
										</center>
			    					</div>
			  					</div>
							</center>
						</div>
					</div>

					<div class="ui-block-b">
						<center>
							<div id="div_btns_operaciones" >
								<!-- PopUp Agregar Operacion -->
			  					<div data-role="main" class="ui-content" id="btnAgregarOpe_FM" data-inline="true">
			    					<a href="#popupAgregarOperacion" id="btnAgregarOpe" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar Operacion</a>
			    					<div data-role="popup" id="popupAgregarOperacion" class="ui-content">
			      						<label for="operacion">Operacion</label>
			      						<input type="text" id="operacionAgrega">
			      						<label for="descripcion">Descripcion</label>
			      						<input type="text" id="descripcionAgrega">

			      						<fieldset data-iconpos="right">
			      							<input name="checkbox" id="checkbox-h-6a" type="checkbox">
			        						<label for="checkbox-h-6a">Usar en PPms?</label>
			      						</fieldset>

			      						<label for="grupo">Grupo</label>
			      						<select name="grupoAgrega" id="grupoAgrega">
											<option value="default">- - - - - - -</option>
											<option value="final_test">Final Test</option>
											<option value="qc_audit">QC Audit</option>
											<option value="process">Process</option>
										</select>
										<a id="confirmarAgregado" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
										<a id="cancelarAgregado" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
			    					</div>
			  					</div>

			  					<!-- PopUp Guardar Operacion -->
			  					<div data-role="main" class="ui-content" data-inline="true">
			    					<a href="#popupGuardarOperacion" id="btnGuardarOpe_FM" data-rel="popup" class="ui-btn ui-icon-check ui-btn-icon-left ui-btn-inline ui-corner">Guardar Operacion</a>
			    					<div data-role="popup" id="popupGuardarOperacion" class="ui-content">
			      						<h3>Guardar Operacion</h3><hr>
			      						<p>Confirmacion para guardar la <b>Operacion</b></p>
			      						<center>
											<a id="eliminarOperacion" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
											<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
										</center>
			    					</div>
			  					</div>

			  					<!-- PopUp Eliminar Operacion -->
			  					<div data-role="main" class="ui-content" id="divElimarOp_FM" data-inline="true">
			    					<a href="#popupEliminarOperacion" id="btnEliminarOpe" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar Operacion</a>
			    					<div data-role="popup" id="popupEliminarOperacion" class="ui-content">
			      						<h3>Eliminar Operacion</h3><hr>
			      						<p>Estas seguro de eliminar esta <b>Operacion</b>???</p>
			      						<center>
											<a id="eliminarOperacion" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
											<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
										</center>
			    					</div>
			  					</div>

			  					<!-- PopUp Copiar Operacion-->
								<div data-role="main" class="ui-content" id="divCopiarOp_FM" data-inline="true">
			    					<a href="#popupCopiarOperacion" id="btnCopiaOp" data-rel="popup" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline ui-corner">Copiar Operacion</a>
			    					<div data-role="popup" id="popupCopiarOperacion" class="ui-content">
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
											<a id="copiarOperacion" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
											<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
										</center>
			    					</div>
			  					</div>
							</div>
						</center>
					</div>

					<div class="ui-block-c">
						<div id="divTabla_Operaciones">	
							<table id="tablaOperaciones" cellpadding="0" cellspacing="0" border="0" class="hover">
								<thead>
									<tr>
										<th width="100" align="left">Operacion</th>
										<th width="330" align="left">Descripcion</th>
										<th width="130" align="left">PPms</th>
										<th width="120" align="left">Grupo</th>
									</tr>
								</thead>
								<tbody id="content_operaciones">
								</tbody>
							</table>
						</div>
					</div>

				</div><br><br>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../../../js/js_tables.js"></script>

</body>
</html>