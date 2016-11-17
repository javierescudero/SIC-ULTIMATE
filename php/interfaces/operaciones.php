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
<style type="text/css">
	@media screen and (max-width: 1800px) {
	    #divTabla_Op {
	    	width: 70%;
	    	max-height: 350px;
	    }
	    #divContentModelo_Op {
	    	width: 35%;
	    }
	}
</style>
<body>
	<?php
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

	<div data-role="page" data-theme="b" id="">
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Operaciones<br>Operations
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

		<div id="divForm_Op">
			<form action="">
				<center>
					<div data-role="fieldcontain" id="divContentModelo_Op">
						<center>
							<label for="modelo"><b>Modelo</b></label>
						</center>
						<select name="modelo" id="modelo">
							<option value="default">- - - Selecciona Un Modelo - - -</option>
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
				</center>
				<center>

					<script type="text/javascript">
						var flag = true;
						$(function() {
							$("select#modelo").change(function() {
								//Carga las operaciones al seleccionar un modelo.
								var loadOp2 = $("table#tablaOperaciones");
								$.getJSON("../getsJSON/get_operaciones_xModelo.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
									var tr = "";
									for (var i = 0; i < j.length; i++) {

										tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
										
										tr += '<td><span id="'+j[i].Operacion+'" ><a class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

										if (j[i].UsarPPms == 1) {
											tr += '<td><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" checked><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
										} else {
											tr += '<td><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox"><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
										}

										tr += '<td><select name="'+j[i].Grupo+'" id="'+j[i].Grupo+'" ><option value="default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="final_test">Final Test</option><option value="qc_audit">QC Audit</option><option value="process">Process</option></select></td></tr>';
									}
									$("tbody#content_operaciones").html(tr);
								});

								/*$('span').bind('mouseenter', function(e) {
								  	$(this).attr('contenteditable','true');
								});*/
							});
						});
					</script>

					<div id="divBtnsOperaciones_Op">

						<script type="text/javascript">
							$(document).ready(function() {
									
									//Agregar Operacion
									$("a#agregarOperacionConfirmacion").click(function(){
										alert('Click Guardar');
										var valModelo = document.getElementById('modelo').value;
										alert('Modelo = ' + valModelo);

										var valOperacion = document.getElementById('agregarOperacion').value;
										alert('Operacion = ' + valOperacion);

										var valDescripcion = document.getElementById('agregarDescripcion').value;
										alert('Descripcion = ' + valDescripcion);

										var valPPms = $("#checkbox-h-6c").prop("checked");
										alert('PPms = ' + valPPms);

										var valGrupo = document.getElementById('agregarGrupo').value;
										alert('Grupo = ' + valGrupo);

										var loadOp2 = $("table#tablaOperaciones");
										$.getJSON("../getsJSON/add_Operacion_op.php", {ajax: true, modelo: valModelo, operacion: valOperacion, descripcion: valDescripcion, ppms: valPPms, grupo: valGrupo, area: <?php echo "'$area'"; ?> }, function(j) {
											var tr = "";
											for (var i = 0; i < j.length; i++) {

												tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
												
												tr += '<td><span id="'+j[i].Operacion+'" ><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

												if (j[i].UsarPPms == 1) {
													tr += '<td><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" checked><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												} else {
													tr += '<td><fieldset data-iconpos="left"  ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox"><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												}

												tr += '<td><select name="'+j[i].Grupo+'" id="'+j[i].Grupo+'" ><option value="default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="final_test">Final Test</option><option value="qc_audit">QC Audit</option><option value="process">Process</option></select></td></tr>';
											}
											$("tbody#content_operaciones").html(tr);

											//$(".checkbox").attr("checked", false);
											//$("input:checkbox").prop('checked', false);
											//$(".checkbox").prop('checked', false);

											//valGrupo = document.getElementById('grupoAgrega').selected = 'default';


										});
										valOperacion = document.getElementById('agregarOperacion').value = '';
										valDescripcion = document.getElementById('agregarDescripcion').value = '';

										$('#cancelar').click();
									});
							});
						</script>

						<!-- PopUp Agregar Operacion -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupAgregar" id="btnAgregar" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    						<div data-role="popup" id="popupAgregar" class="ui-content">
      							<label for="operacion">Operacion</label>
      							<input type="text" id="agregarOperacion">
      							<label for="descripcion">Descripcion</label>
      							<input type="text" id="agregarDescripcion">
      							<fieldset data-iconpos="right">
      								<input name="checkbox" id="checkbox-h-6c" type="checkbox">
        							<label for="checkbox-h-6c">Usar en PPms?</label>
      							</fieldset>
      							<label for="grupo">Grupo</label>
      							<select name="agregarGrupo" id="agregarGrupo">
									<option value="default">- - - - - - -</option>
									<option value="final_test">Final Test</option>
									<option value="qc_audit">QC Audit</option>
									<option value="process">Process</option>
								</select>
								<a id="agregarOperacionConfirmacion" href="" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelar" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<script type="text/javascript">
							$(function() {
								
								var valOperacion;
								$('tbody').click(function (e) {
									valOperacion = e.target.id;
									//alert('valOperacion = ' + valOperacion);
								});

								//Eliminar Operacion
								$("a#eliminar").click(function(){
									//alert('valOperacion = ' + valOperacion);
									var valModelo = document.getElementById('modelo').value;
									if (valModelo == 'default') {
										alert('Debes seleccionar algun modelo...');
										return false;
									}else {
										//alert('Modelo = ' + valModelo);

										var loadOp2 = $("table#tablaOperaciones");
										$.getJSON("../getsJSON/del_Operacion.php", {ajax: true, modelo: valModelo, operacion: valOperacion, area: <?php echo "'$area'"; ?> }, function(j) {
											var tr = "";
											for (var i = 0; i < j.length; i++) {

												tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
												
												tr += '<td><span id="'+j[i].Operacion+'" ><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

												if (j[i].UsarPPms == 1) {
													tr += '<td><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" checked><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												} else {
													tr += '<td><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox"><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												}

												tr += '<td><select name="'+j[i].Grupo+'" id="'+j[i].Grupo+'" ><option value="default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="final_test">Final Test</option><option value="qc_audit">QC Audit</option><option value="process">Process</option></select></td></tr>';

											}
											$("tbody#content_operaciones").html(tr);


										});
										alert('Operacion Eliminada');
										$("tbody#content_operaciones").refresh(true);
										$('#salir').click();
									}

								});

								$(document).ready(function(e) {
									//$("select#familias").change();
									$("select#modelos").change();
								});
							});
						</script>

  						<!-- PopUp Eliminar Operacion -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupEliminar" id="btnEliminar" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    						<div data-role="popup" id="popupEliminar" class="ui-content">
      							<h3>Eliminar Operacion</h3><hr>
      							<p>Estas seguro de eliminar esta <b>Operacion</b>???</p>
      							<center>
									<a id="eliminar" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
									<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
								</center>
    						</div>
  						</div>

  						<script type="text/javascript">
  							//Copiar Operaciones
							$(document).ready(function(){
								$("a#copiar").click(function() {
									var modeloOrigen = document.getElementById('mod_origen').value;
									var modeloDestino = document.getElementById('mod_destino').value;
									var loadOp = $("table#tablaOperaciones");

									//alert('Origen = ' + modeloOrigen);
									//alert('Destino = ' + modeloDestino);

									$.getJSON("../getsJSON/copy_operaciones.php", {ajax: true, origen: modeloOrigen, destino: modeloDestino, area: <?php echo "'$area'"; ?>}, function(j) {
										var tr = "";
										for (var i = 0; i < j.length; i++) {
											
											tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
											
											tr += '<td><span id="' + j[i].Operacion + '"><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' + j[i].Operacion + '</a></span></td><td><span class="ui-btn" id="' + j[i].Descripcion + '">' + j[i].Descripcion + '</span></td>';

											if (j[i].UsarPPms == 1) {
												tr += '<td><fieldset data-iconpos="left"><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox" checked><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
											} else {
												tr += '<td><fieldset data-iconpos="left"><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox"><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
											}

											tr += '<td><select name="' + j[i].Grupo + '" id="' + j[i].Grupo + '" ><option value="default" >- - - - - - -</option><option value="' + j[i].Grupo + '" selected>' + j[i].Grupo + '</option><option value="final_test">Final Test</option><option value="qc_audit">QC Audit</option><option value="process">Process</option></select></td></tr>';
										}
										$("tbody#content_operaciones").html(tr);

									});
									alert('Operaciones Copiadas');
									
									$("a#salir").click();
								});
							});
	  					</script>

  						<!-- PopUp Copiar Operacion-->
						<div data-role="main" class="ui-content">
    						<a href="#popupCopiar" id="btnCopia" data-rel="popup" class="ui-btn ui-icon-bars ui-btn-icon-left ui-btn-inline ui-corner">Copiar</a>
    						<div data-role="popup" id="popupCopiar" class="ui-content">
      							<h3>Copiar Operaciones</h3><hr>
								<div data-role="fieldcontain" id="">
									<center><label for="mod_origen"><b>Modelo Origen</b></label></center>
									<select name="mod_origen" id="mod_origen">
										<option value="default">- - - Selecciona Un Modelo - - -</option>
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
										<option value="default">- - - Selecciona Un Modelo - - -</option>
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
									<a id="copiar" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
									<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
								</center>
    						</div>
  						</div>

  						<!-- PopUp Editar Operacion-->
    					<div data-role="popup" id="popupEditarOperacion" class="ui-content">
      						<label for="operacion">Operacion</label>
      						<input type="text" id="operacionAgrega">
      						<label for="descripcion">Descripcion</label>
      						<input type="text" id="descripcionAgrega">

      						<fieldset data-iconpos="right">
      							<input name="checkbox" id="checkbox-h-5a" type="checkbox" class="checkbox">
        						<label for="checkbox-h-5a">Usar en PPms?</label>
      						</fieldset>

      						<label for="grupo">Grupo</label>
      						<select name="grupoEdita" id="grupoEdita">
								<option value="default">- - - - - - -</option>
								<option value="Final_test">Final Test</option>
								<option value="Qc_audit">QC Audit</option>
								<option value="Process">Process</option>
							</select>
							<a id="guardarCambios" href="#" data-role="button" data-icon="check" data-inline="true">Guardar</a>
							<a id="cancelarEdicion" href="" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    					</div>
					</div>
				</center>
				<center>
				<div id="divTabla_Op">
						<table id="tablaOperaciones" cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr>
								<th width="60" align="left">Selec.</th>
								<th width="60" align="left">Operacion</th>
								<th width="280" align="left">Descripcion</th>
								<th width="130" align="left">Usar en PPms?</th>
								<th width="120" align="left">Grupo</th>
							</tr>
						</thead>
						<tbody id="content_operaciones">
						</tbody>
				</div>
			</center>
			</form>
		</div>
	</div>
</body>
</html>