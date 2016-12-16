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
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<title>SIC Ultimate</title>

	<?php include("../../php/librerias.php"); ?>
</head>

<style type="text/css">
	@media screen and (min-width: 480px) {
	    #divColumnas {
	        width: 100%;
	    }

	    #divTabla_Operaciones {
	    	max-height: 600px;
	    	width: 160%;
	    }
	}
	@media screen and (max-width: 1800px) {
	     #divColumnas {
	        width: 140%;
	     	margin-left: -15%;
	    }
	    #btns_ajustar {
	    	display: inline;
	    }
	    #divTabla_Operaciones {
	    	max-height: 600px;
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

		function cargaModelos($conn, $database) {
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Modelo FROM modelos ORDER BY Modelo");
			$num_rows = mysqli_num_rows($query);
			if ($num_rows != 0) {
				while ($row = mysqli_fetch_assoc($query)) {
					echo "<option value='".$row['Modelo']."'>".$row['Modelo']."</option>";
				}
			} else {
				echo "Error: " . $query . "<br>" . mysqli_error($con);
			}
			mysqli_close($con);
		}
	?>

	<div data-role="page" data-theme="b" id="divPage">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Familias / Modelos<br>Families / Models
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
		<div id="divForm_FM">
			<form action="">
				<div class="ui-grid-c" id="divColumnas">
					<div class="ui-block-a" id="divColA">
						<div id="divListas">

							<script type="text/javascript">
								$(function() {
									$("select#familias").change(function() {
										//Carga los modelos al seleccionar una familia.
										$.getJSON("../getsJSON/get_modelos.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
											var options = '<option value="Default">- - - Selecciona Un Modelo - - -</option>\n';

											if (j[0] == '') {
												$('#modelos').val('Default').attr('selected', true).selectmenu("refresh");
											} else {
												for (var i = 0; i < j.length; i++) {		
													options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
												}
											}
											
											$("select#modelos").html(options);
										});

										//Carga las operaciones al seleccionar una familia.
										$.getJSON("../getsJSON/get_operaciones_xFamilia.php", {ajax: true, familia: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
											var tr = "";

											if (j[0] == '') {
											} else {
												for (var i = 0; i < j.length; i++) {

													tr += '<tr><td id="'+j[i].Operacion+'" class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'" ><label for="' + j[i].Operacion + '"></label></fieldset></td>';
													
													tr += '<td id="' + j[i].Operacion + '" class="btnOperacion"><span id="' + j[i].Operacion + '"><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' + j[i].Operacion + '<a></span></td><td id="' + j[i].Descripcion + '" class="descripcion"><span class="ui-btn" id="' + j[i].Descripcion + '" >' + j[i].Descripcion + '</span></td>';

													if (j[i].UsarPPms == 1) {
														tr += '<td id="' + j[i].UsarPPms + '" class="checkPPms"><fieldset data-iconpos="left" ><input id="' + j[i].UsarPPms + '" type="checkbox" checked disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
													} else {
														tr += '<td id="' + j[i].UsarPPms + '" class="checkPPms"><fieldset data-iconpos="left" ><input id="' + j[i].UsarPPms + '" type="checkbox" disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
													}

													tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="' + j[i].Grupo + '" selected>' + j[i].Grupo + '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';
												}
											}

											$("tbody#content_operaciones").html(tr);
										});

									});

									$("select#modelos").change(function() {
										
										//Carga las operaciones al seleccionar un modelo.
										$.getJSON("../getsJSON/get_operaciones_xModelo.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
											var tr = "";

											if (j[0] == '') {
											} else {
												for (var i = 0; i < j.length; i++) {

													tr += '<tr><td id="'+j[i].Operacion+'" class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
													
													tr += '<td id="'+j[i].Operacion+'" class="btnOperacion"><span id="'+j[i].Operacion+'" ><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td id="'+j[i].Descripcion+'" class="descripcion"><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

													if (j[i].UsarPPms == 1) {
														tr += '<td id="'+j[i].UsarPPms+'" class="checkPPms"><fieldset data-iconpos="left" ><input id="'+j[i].UsarPPms+'" type="checkbox" checked disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
													} else {
														tr += '<td id="'+j[i].UsarPPms+'" class="checkPPms"><fieldset data-iconpos="left" ><input id="'+j[i].UsarPPms+'" type="checkbox" disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
													}

													tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';

												}
											}

											$("tbody#content_operaciones").html(tr);

										});

									});
									
								});

							</script>

							<!-- CARGA FAMILIAS -->
							<center><label for="divFamilia_FM" id="lblFamilia" data-theme="c"><b>Familias</b></label></center>
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

							<center>

								<script type="text/javascript">
									$(function() {
										
										//Agregar Familia
										$("#agregarFamilia").click(function(){
											var valFamilia = document.getElementById('pop_inputAgregaFamilia').value;

											if (valFamilia == '') {
												alert('Ingresar Familia');
											} else {
												$.getJSON("../getsJSON/add_Familia.php", {ajax: true, familia: valFamilia, area: <?php echo "'$area'"; ?> }, function(j) {
													var options = '<option value="Default">- - - Selecciona Una Familia - - -</option>\n';
													for (var i = 0; i < j.length; i++) {
														options += '<option value="'+ j[i].Familias +'">'+ j[i].Familias +'</option> \n';
													}
													
													alert('Familia se agrego correctamente');
													
													$("select#familias").html(options);
													
													document.getElementById('pop_inputAgregaFamilia').value = '';
													
													$('#cancelarAgregarFamilia').click();
												});
											}
										});

									});
								</script>

								<!-- PopUp Agregar Familia-->
								<div data-role="main" class="ui-content" id="btns_ajustar">
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

			  					<script type="text/javascript">
									$(function() {
										
										//Eliminar Familia
										$("#eliminarFamilia").click(function(){

											var valFamilia = document.getElementById('familias').value;
											$.getJSON("../getsJSON/del_Familia.php", {ajax: true, familia: valFamilia, area: <?php echo "'$area'"; ?> }, function(j) {
												
												var options = '<option value="Default">- - - Selecciona Una Familia - - -</option>\n';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="'+ j[i].Familias +'">'+ j[i].Familias +'</option> \n';
												}
												
												alert('Familia se elimino correctamente');

												$("select#familias").html(options);

												$('#familias').val('Default').attr('selected', true).selectmenu("refresh");

											});
											$('#cancelDel_Familia').click();

										});

									});
								</script>

			  					<!-- PopUp Elimnar Familia-->
			  					<div data-role="main" class="ui-content" id="btns_ajustar">
			    					<a href="#popupEliminarFamilia" id="btnEliminarFam" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
			    					<div data-role="popup" id="popupEliminarFamilia" class="ui-content">
			      						<h3>Eliminar Familia</h3>
			      						<p>Estas seguro de eliminar esta <b>Familia</b>???<br>
			      							Esta familia contiene modelos.</p>
			      						<center>
											<a id="eliminarFamilia" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
											<a id="cancelDel_Familia" href="" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
										</center>
			    					</div>
			  					</div><br><br><br><br>
							</center>

							<center><label for="divModelos_FM" id="lblModelos" data-theme="c"><b>Modelos</b></label></center>
							<select name="modelos" id="modelos">
								<option value="Default">- - - Selecciona un modelo - - -</option>
							</select>

							<center>

								<script type="text/javascript">
									$(function() {
										
										//Agregar Modelo
										$("#agregarMod").click(function() {
											var valModelo = document.getElementById('pop_inputAgregaModelo_FM').value;
											var valFamilia = document.getElementById('familias').value;

											if (valFamilia == 'Default') {
												alert('Selecciona Una Familia');
											}

											$.getJSON("../getsJSON/add_Modelo.php", {ajax: true, familia: valFamilia, modelo: valModelo, area: <?php echo "'$area'"; ?> }, function(j) {
												var options = '<option value="Default">- - - Selecciona Un Modelo - - -</option>\n';

												if (j.length != null) {
													if (j[0] == 'default_familia') {
														alert('Debes Seleccionar Una Familia');
													} else {
														for (var i = 0; i < j.length; i++) {
															options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
														}
														alert('MODELO se agrego correctamente');
													}
												}

												$("select#modelos").html(options);

												document.getElementById('pop_inputAgregaModelo_FM').value = '';

												$('#modelos').val('Default').attr('selected', true).selectmenu("refresh");
												
												$('#cancelarAgregarModelo').click();

											});

											//Carga los modelos origen y destino al seleccionar una familia.
											$.getJSON("../getsJSON/get_copyModelos.php", {ajax: true, area: <?php echo "'$area'"; ?>}, function(j) {
												var options = '<option value="Default">- - - Selecciona Un Modelo - - -</option>\n';

												for (var i = 0; i < j.length; i++) {				
													options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
												}
												$("select#mod_origen").html(options);
												$("select#mod_destino").html(options);

											});
										});

									});
								</script>

								<!-- PopUp Agregar Modelo-->
								<div data-role="main" class="ui-content" id="btns_ajustar">
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

			  					<script type="text/javascript">
									$(function() {
										
										//Eliminar Modelo
										$("a#eliminarModelo").click(function(){
											var valModelo = document.getElementById('modelos').value;
											var valFamilia = document.getElementById('familias').value;

											$.getJSON("../getsJSON/del_Modelo.php", {ajax: true, familia: valFamilia, modelo: valModelo, area: <?php echo "'$area'"; ?> }, function(j) {
												
												var options = '<option value="Default">- - - Selecciona Un Modelo - - -</option>\n';
												for (var i = 0; i < j.length; i++) {
													options += '<option value="'+ j[i].Modelo +'">'+ j[i].Modelo +'</option> \n';
												}
												alert('MODELO se elimino correctamente');

												$("select#modelos").html(options);

												$('#modelos').val('Default').attr('selected', true).selectmenu("refresh");

											});

											$('#cancelDel_Modelo').click();
										});

									});
								</script>

			  					<!-- PopUp Elimnar Modelo-->
			  					<div data-role="main" class="ui-content" id="btns_ajustar">
			    					<a href="#popupEliminarModelo" id="btnAgregarMod" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
			    					<div data-role="popup" id="popupEliminarModelo" class="ui-content">
			      						<h3>Eliminar Modelo</h3>
			      						<p>Estas seguro de eliminar este <b>Modelo</b>???</p>
			      						<center>
											<a id="eliminarModelo" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
											<a id="cancelDel_Modelo" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
										</center>
			    					</div>
			  					</div>

							</center>
						</div>
					</div>

					<div class="ui-block-b" id="divColB">
						<center>
							<div id="div_btns_operaciones" >

								<script type="text/javascript">
									$(function() {
										
										//Agregar Operacion
										$("#confirmarAgregado").click(function(){
											var valFamilia = document.getElementById('familias').value;
											var valModelo = document.getElementById('modelos').value;
											var valOperacion = document.getElementById('operacionAgrega').value;
											var valDescripcion = document.getElementById('descripcionAgrega').value;
											var valPPms = $("#checkbox-h-6a").prop("checked");
											var valGrupo = document.getElementById('grupoAgrega').value;

											if (valFamilia == 'Default' || valModelo == 'Default') {
												alert('Debes Seleccionar Familia y Modelo');
											} else {
												$.getJSON("../getsJSON/add_Operacion.php", {ajax: true, familia: valFamilia, modelo: valModelo, operacion: valOperacion, descripcion: valDescripcion, ppms: valPPms, grupo: valGrupo, area: <?php echo "'$area'"; ?> }, function(j) {
													var tr = "";

													if (j[0] == '') {
													} else {
														for (var i = 0; i < j.length; i++) {

															tr += '<tr><td id="'+j[i].Operacion+'" class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
															
															tr += '<td id="'+j[i].Operacion+'" class="btnOperacion"><span id="'+j[i].Operacion+'" ><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td id="'+j[i].Descripcion+'" class="descripcion"><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

															if (j[i].UsarPPms == 1) {
																tr += '<td id="'+j[i].UsarPPms+'" class="checkPPms"><fieldset data-iconpos="left" ><input id="'+j[i].UsarPPms+'" type="checkbox" checked disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
															} else {
																tr += '<td id="'+j[i].UsarPPms+'" class="checkPPms"><fieldset data-iconpos="left"  ><input id="'+j[i].UsarPPms+'" type="checkbox" disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
															}

															tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';
														}
													}
	 
													$("tbody#content_operaciones").html(tr);

													document.getElementById('modelos').value = '';
													document.getElementById('operacionAgrega').value = '';
													document.getElementById('descripcionAgrega').value = '';
													$('#checkbox-h-6a').attr('checked', false).checkboxradio('refresh');
													$('#grupoAgrega').val('Default').attr('selected', true).selectmenu("refresh");

													$('#cancelarAgregado').click();

													alert('Operacion se agrego correctamente');

												});
											}

										});

									});
								</script>

								<!-- PopUp Agregar Operacion -->
			  					<div data-role="main" class="ui-content" id="btnAgregarOpe_FM" data-inline="true">
			    					<a href="#popupAgregarOperacion" id="btnAgregarOpe" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar Operacion</a>
			    					<div data-role="popup" id="popupAgregarOperacion" class="ui-content">
			      						<label for="operacion">Operacion</label>
			      						<input type="text" id="operacionAgrega">
			      						<label for="descripcion">Descripcion</label>
			      						<input type="text" id="descripcionAgrega">

			      						<fieldset data-iconpos="right">
			      							<input name="checkbox" id="checkbox-h-6a" type="checkbox" class="checkbox">
			        						<label for="checkbox-h-6a">Usar en PPms?</label>
			      						</fieldset>

			      						<label for="grupo">Grupo</label>
			      						<select name="grupoAgrega" id="grupoAgrega">
											<option value="Default">- - - - - - -</option>
											<option value="Final Test">Final Test</option>
											<option value="QC Audit">QC Audit</option>
											<option value="Process">Process</option>
										</select>
										<a id="confirmarAgregado" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
										<a id="cancelarAgregado" href="" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
			    					</div>
			  					</div>

			  					<script type="text/javascript">
									$(function() {
										
										var valOperacion;
										$('tbody').click(function (e) {
											valOperacion = e.target.id;
										});

										//Eliminar Operacion
										$("a#eliminarOperacion").click(function(){
											var valModelo = document.getElementById('modelos').value;
											if (valModelo == 'Default') {
												alert('Debes seleccionar algun modelo...');
												return false;
											}else {

												var loadOp2 = $("table#tablaOperaciones");
												$.getJSON("../getsJSON/del_Operacion.php", {ajax: true, modelo: valModelo, operacion: valOperacion, area: <?php echo "'$area'"; ?> }, function(j) {
													var tr = "";

													if (j[0] == '') {

													} else {
														for (var i = 0; i < j.length; i++) {

															tr += '<tr><td id="'+j[i].Operacion+'" class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
															
															tr += '<td id="'+j[i].Operacion+'" class="btnOperacion"><span id="'+j[i].Operacion+'" ><a id="'+j[i].Operacion+'" class="ui-btn" href="#?operacion="'+ j[i].Operacion +'"" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td id="'+j[i].Descripcion+'" class="descripcion"><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

															if (j[i].UsarPPms == 1) {
																tr += '<td id="'+j[i].UsarPPms+'" class="checkPPms"><fieldset data-iconpos="left" ><input id="'+j[i].UsarPPms+'" type="checkbox" checked disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
															} else {
																tr += '<td id="'+j[i].UsarPPms+'" class="checkPPms"><fieldset data-iconpos="left" ><input id="'+j[i].UsarPPms+'" type="checkbox" disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
															}

															tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';

														}
													}


													$("tbody#content_operaciones").html(tr);

													$('#cancelDel_Operacion').click();

												});
											}

										});

										$(document).ready(function(e) {
											//$("select#familias").change();
											$("select#modelos").change();
										});
									});
								</script>

			  					<!-- PopUp Eliminar Operacion -->
			  					<div data-role="main" class="ui-content" id="divElimarOp_FM" data-inline="true">
			    					<a href="#popupEliminarOperacion" id="btnEliminarOpe" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar Operacion</a>
			    					<div data-role="popup" id="popupEliminarOperacion" class="ui-content">
			      						<h3>Eliminar Operacion</h3><hr>
			      						<p>Estas seguro de eliminar esta <b>Operacion</b>???</p>
			      						<center>
											<a id="eliminarOperacion" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
											<a id="cancelDel_Operacion" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
										</center>
			    					</div>
			  					</div>

			  					<script type="text/javascript">
			  							
			  							//Copiar Operaciones
										$(document).ready(function(){
											$("#copiarOperacion").click(function() {
												var modeloOrigen = document.getElementById('mod_origen').value;
												var modeloDestino = document.getElementById('mod_destino').value;

												$.getJSON("../getsJSON/copy_operaciones.php", {ajax: true, origen: modeloOrigen, destino: modeloDestino, area: <?php echo "'$area'"; ?>}, function(j) {
													var tr = "";
													for (var i = 0; i < j.length; i++) {
														
														tr += '<tr><td id="'+j[i].Operacion+'" class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
														
														tr += '<td id="'+j[i].Operacion+'" class="btnOperacion"><span id="' + j[i].Operacion + '"><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' + j[i].Operacion + '</a></span></td><td id="' + j[i].Descripcion + '" class="descripcion"><span class="ui-btn" id="' + j[i].Descripcion + '">' + j[i].Descripcion + '</span></td>';

														if (j[i].UsarPPms == 1) {
															tr += '<td id="' + j[i].UsarPPms + '" class="checkPPms"><fieldset data-iconpos="left"><input id="' + j[i].UsarPPms + '" type="checkbox" checked disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
														} else {
															tr += '<td id="' + j[i].UsarPPms + '" class="checkPPms"><fieldset data-iconpos="left"><input id="' + j[i].UsarPPms + '" type="checkbox" disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
														}

														tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="' + j[i].Grupo + '" selected>' + j[i].Grupo + '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';

													}
													
													$("tbody#content_operaciones").html(tr);

													$('#mod_origen').val('Default').attr('selected', true).selectmenu("refresh");
													$('#mod_destino').val('Default').attr('selected', true).selectmenu("refresh");

												});
												
												$("#cancelCopy_Operacion").click();

											});
										});
			  					</script>

			  					<!-- PopUp Copiar Operacion-->
								<div data-role="main" class="ui-content" id="divCopiarOp_FM" data-inline="true">
			    					<a href="#popupCopiarOperacion" id="btnCopiaOp" data-rel="popup" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline ui-corner">Copiar Operacion</a>
			    					<div data-role="popup" id="popupCopiarOperacion" class="ui-content">
			      						<h3>Copiar Operaciones</h3><hr>
										<div data-role="fieldcontain" id="">
											<center><label for="mod_origen"><b>Modelo Origen</b></label></center>
											<select name="mod_origen" id="mod_origen">
												<option value="Default">- - - Selecciona Un Modelo - - -</option>
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
										<div data-role="fieldcontain" id="">
											<center><label for="mod_destino"><b>Modelo Destino</b></label></center>
											<select name="mod_destino" id="mod_destino">
												<option value="Default">- - - Selecciona Un Modelo - - -</option>
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
			      						<center>
											<a id="copiarOperacion" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
											<a id="cancelCopy_Operacion" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
										</center>
			    					</div>
			  					</div>

			  					<script type="text/javascript">
			  						$(document).ready(function() {
			  							$('#guardarCambios').click(function() {

			  								var familia = document.getElementById('familias').value;
			  								var modelo = document.getElementById('modelos').value;
			  								var operacion = document.getElementById('operacionEdita').value;
			  								var descripcion = document.getElementById('descripcionEdita').value;
			  								var usarppms = $('#checkbox-h-5a').is(':checked');
			  								var grupo = document.getElementById('grupoEdita').value;

			  								alert('Familia: ' + familia + '\nModelo: ' + modelo + '\nOperacion: ' + operacion + '\nDescripcion: ' + descripcion + '\nUsarPPms: ' + usarppms + '\nGrupo: ' + grupo);

			  								$.getJSON("../getsJSON/set_operaciones.php", {ajax: true, familia: familia, modelo: modelo, operacion: operacion, descripcion: descripcion, usarppms: usarppms, grupo: grupo, area: <?php echo "'$area'"; ?>}, function(j) {
												
												var tr = "";

												if (j[0] == 'default') {
													alert('No se encontraron Operaciones');
												} else if (j[0] == 'error') {
													alert('ERROR!!!\nAl intentar actualizar');
												} else {

													for (var i = 0; i < j.length; i++) {
														
														tr += '<tr><td id="'+j[i].Operacion+'" class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
														
														tr += '<td id="'+j[i].Operacion+'" class="btnOperacion"><span id="' + j[i].Operacion + '"><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' + j[i].Operacion + '</a></span></td><td id="' + j[i].Descripcion + '" class="descripcion"><span class="ui-btn" id="' + j[i].Descripcion + '">' + j[i].Descripcion + '</span></td>';

														if (j[i].UsarPPms == 1) {
															tr += '<td id="' + j[i].UsarPPms + '" class="checkPPms"><fieldset data-iconpos="left"><input id="' + j[i].UsarPPms + '" type="checkbox" checked disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
														} else {
															tr += '<td id="' + j[i].UsarPPms + '" class="checkPPms"><fieldset data-iconpos="left"><input id="' + j[i].UsarPPms + '" type="checkbox" disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
														}

														tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="' + j[i].Grupo + '" selected>' + j[i].Grupo + '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';

													}
													
													$("tbody#content_operaciones").html(tr);

													document.getElementById('modelos').value = '';
													document.getElementById('operacionAgrega').value = '';
													document.getElementById('descripcionAgrega').value = '';
													$('#checkbox-h-5a').attr('checked', false).checkboxradio('refresh');
													$('#grupoAgrega').val('Default').attr('selected', true).selectmenu("refresh");
													$('#modelos').val(modelo).attr('selected', true).selectmenu("refresh");

													alert('Operacion se modifico correctamente.');
													
													$('#cancelarEdicion').click();
												}

											});
			  							});
			  						});
			  					</script>

			  					<!-- PopUp Editar Operacion-->
			  					<div data-role="popup" id="popupEditarOperacion" class="ui-content">
									<label for="operacion">Operacion</label>
									<input type="text" id="operacionEdita" disabled>
									<label for="descripcion">Descripcion</label>
									<input type="text" id="descripcionEdita">
									<fieldset data-iconpos="right" data-role="controlgroup">
										<input class="check" id="checkbox-h-5a" type="checkbox">
										<label for="checkbox-h-5a">Usar en PPms?</label>
									</fieldset>
									<label for="grupo">Grupo</label>
									<select name="grupoEdita" id="grupoEdita">
										<option value="Default">- - - - - - -</option>
										<option value="Final Test">Final Test</option>
										<option value="QC Audit">QC Audit</option>
										<option value="Process">Process</option>
									</select>
									<a id="guardarCambios" href="#" data-role="button" data-icon="check" data-inline="true">Guardar</a>
									<a id="cancelarEdicion" href="" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
								</div>

							</div>
						</center>
					</div>

					<div class="ui-block-c" id="divColC">
						<div id="divTabla_Operaciones">	
							<table id="tablaOperaciones" cellpadding="0" cellspacing="0" border="0" class="hover">
								<thead>
									<tr>
										<th width="100" align="left">Selec.</th>
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
	<script type="text/javascript">
		$(document).ready(function() {
			var btn1="";
			var btn2="";
			var btn3="";
			var btn4="";

			$("#popupEditarOperacion").on({
				popupafteropen: function(event, ui) {
					$(event.currentTarget).find('#operacionEdita').val(btn1);
					$(event.currentTarget).find('#descripcionEdita').val(btn2);
					
					if (btn3) {
						$(event.currentTarget).find('#checkbox-h-5a').prop('checked', true);
					} else {
						$(event.currentTarget).find('#checkbox-h-5a').prop('checked', false);
					}
					
					if (btn4 == 'Process') {
						$(event.currentTarget).find('#grupoEdita option[value = "Process"]').prop('selected', true);
					} else if (btn4 == 'Final Test') {
						$(event.currentTarget).find('#grupoEdita option[value = "Final Test"]').prop('selected', true);
					} else if (btn4 == 'QC Audit') {
						$(event.currentTarget).find('#grupoEdita option[value = "QC Audit"]').prop('selected', true);
					} else if (btn4 == 'null') {
						$(event.currentTarget).find('#grupoEdita option[value = "Default"]').prop('selected', true);
						btn4 = 'Default';
					} else if (btn4 == '') {
						$(event.currentTarget).find('#grupoEdita option[value = "Default"]').prop('selected', true);
						btn4 = 'Default';
					}

					$(event.currentTarget).find('#grupoEdita').val(btn4).selectmenu('refresh', true);
					$(event.currentTarget).find('#checkbox-h-5a').checkboxradio('refresh', true);
				}
			});

			$("#content_operaciones").on("click", "td:nth-of-type(2)", function() {
				
				btn1=$(this).children('span').children('a').attr('id');

				btn2=$(this).siblings('.descripcion').children('span').attr('id');

				btn3=$(this).siblings('.checkPPms').children('fieldset').children('input').is(':checked');

				btn4=$(this).siblings('.selectGrupo').children('select').prop('value');

			});

			$('#popupAgregarModelo').on({
				popupafterclose: function(event, ui) {
					document.getElementById('pop_inputAgregaModelo_FM').value = '';
				}
			});

			$('#popupCopiarOperacion').on({
				popupafterclose: function(event, ui) {
					$('#mod_origen').val('Default').attr('selected', true).selectmenu("refresh");
					$('#mod_destino').val('Default').attr('selected', true).selectmenu("refresh");
				}
			});

			$('#popupAgregarOperacion').on({
				popupafterclose: function(event, ui) {
					document.getElementById('operacionAgrega').value = '';
					document.getElementById('descripcionAgrega').value = '';
					$('#checkbox-h-6a').prop('checked', false).checkboxradio('refresh');
					$('#grupoAgrega').val('Default').attr('selected', true).selectmenu("refresh");
				}
			});
		});
	</script>
</body>
</html>