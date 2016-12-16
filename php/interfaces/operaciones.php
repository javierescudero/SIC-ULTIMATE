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
				</center>
				<center>

					<script type="text/javascript">
						$(function() {
							$("select#modelo").change(function() {

								//Carga las operaciones al seleccionar un modelo.
								$.getJSON("../getsJSON/get_operaciones_xModelo.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
									var tr = "";
									if (j.length != null) {
										if (j[0] == '') {
										} else {
											for (var i = 0; i < j.length; i++) {

												tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>';
												
												tr += '<td class="btnOperacion"><span><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td class="descripcion"><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

												if (j[i].UsarPPms == 1) {
													tr += '<td class="checkPPms"><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" checked disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												} else {
													tr += '<td class="checkPPms"><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
												}

												tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';
											}
										}
									}
									
									$("tbody#content_operaciones").html(tr);
								});
							});
						});
					</script>

					<div id="divBtnsOperaciones_Op">

						<script type="text/javascript">
							$(document).ready(function() {

								//Agregar Operacion
								$("a#agregarOperacionConfirmacion").click(function(){
									var valModelo = document.getElementById('modelo').value;

									var valOperacion = document.getElementById('agregarOperacion').value;

									var valDescripcion = document.getElementById('agregarDescripcion').value;

									var valPPms = $("#checkbox-h-6c").prop("checked");

									var valGrupo = document.getElementById('agregarGrupo').value;

									$.getJSON("../getsJSON/add_Operacion_op.php", {ajax: true, modelo: valModelo, operacion: valOperacion, descripcion: valDescripcion, ppms: valPPms, grupo: valGrupo, area: <?php echo "'$area'"; ?> }, function(j) {
										var tr = "";
										for (var i = 0; i < j.length; i++) {

											tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
											
											tr += '<td class="btnOperacion"><span id="'+j[i].Operacion+'" ><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td class="descripcion"><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

											if (j[i].UsarPPms == 1) {
												tr += '<td class="checkPPms"><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" checked disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
											} else {
												tr += '<td class="checkPPms"><fieldset data-iconpos="left"  ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
											}

											tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';
										}
										$("tbody#content_operaciones").html(tr);

									});

									document.getElementById('agregarOperacion').value = '';
									document.getElementById('agregarDescripcion').value = '';
									$('#checkbox-h-6c').attr('checked', false).checkboxradio('refresh');
									$('#agregarGrupo').val('Default').attr('selected', true).selectmenu("refresh");

									alert('Se agrego Operacion correctamente');

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
									<option value="Default">- - - - - - -</option>
									<option value="Final Test">Final Test</option>
									<option value="QC Audit">QC Audit</option>
									<option value="Process">Process</option>
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
								});

								//Eliminar Operacion
								$("a#eliminar").click(function(){

									var valModelo = document.getElementById('modelo').value;
									if (valModelo == 'Default') {
										alert('Debes seleccionar algun modelo...');
										return false;
									}else {

										$.getJSON("../getsJSON/del_Operacion.php", {ajax: true, modelo: valModelo, operacion: valOperacion, area: <?php echo "'$area'"; ?> }, function(j) {
											var tr = "";

											if (j[0] == '') {

											} else { 
												for (var i = 0; i < j.length; i++) {

													tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
													
													tr += '<td class="btnOperacion"><span id="'+j[i].Operacion+'" ><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' +j[i].Operacion+ '</a></span></td><td><span class="ui-btn" id="'+j[i].Descripcion+'" >' +j[i].Descripcion+ '</span></td>';

													if (j[i].UsarPPms == 1) {
														tr += '<td class="checkPPms"><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" checked disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
													} else {
														tr += '<td class="checkPPms"><fieldset data-iconpos="left" ><input name="'+j[i].UsarPPms+'" id="'+j[i].UsarPPms+'" type="checkbox" disabled><label for="'+j[i].UsarPPms+'">Usar?</label></fieldset></td>';
													}

													tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="'+j[i].Grupo+'" selected>' +j[i].Grupo+ '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="=Process">Process</option></select></td></tr>';

												}
											}

											$("tbody#content_operaciones").html(tr);

										});
										alert('Operacion Eliminada');
										$('#salir').click();
									}
								});

								$(document).ready(function(e) {
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

									$.getJSON("../getsJSON/copy_operaciones.php", {ajax: true, origen: modeloOrigen, destino: modeloDestino, area: <?php echo "'$area'"; ?>}, function(j) {
										var tr = "";
										for (var i = 0; i < j.length; i++) {
											
											tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Operacion+'"><label></label></fieldset></td>'
											
											tr += '<td class="btnOperacion"><span id="' + j[i].Operacion + '"><a id="'+j[i].Operacion+'" class="ui-btn" href="#popupEditarOperacion" data-rel="popup">' + j[i].Operacion + '</a></span></td><td class="descripcion"><span class="ui-btn" id="' + j[i].Descripcion + '">' + j[i].Descripcion + '</span></td>';

											if (j[i].UsarPPms == 1) {
												tr += '<td class="checkPPms"><fieldset data-iconpos="left"><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox" checked disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
											} else {
												tr += '<td class="checkPPms"><fieldset data-iconpos="left"><input name="' + j[i].UsarPPms + '" id="' + j[i].UsarPPms + '" type="checkbox" disabled><label for="' + j[i].UsarPPms + '">Usar?</label></fieldset></td>';
											}

											tr += '<td class="selectGrupo"><select disabled><option value="Default" >- - - - - - -</option><option value="' + j[i].Grupo + '" selected>' + j[i].Grupo + '</option><option value="Final Test">Final Test</option><option value="QC Audit">QC Audit</option><option value="Process">Process</option></select></td></tr>';
										}
										
										$("tbody#content_operaciones").html(tr);

										$('#mod_origen').val('Default').attr('selected', true).selectmenu("refresh");
										$('#mod_destino').val('Default').attr('selected', true).selectmenu("refresh");

										alert('Operaciones Copiadas');

									});

									$("a#cancelCopy").click();
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
									<a id="copiar" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
									<a id="cancelCopy" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
								</center>
    						</div>
  						</div>

  						<script type="text/javascript">
	  						$(document).ready(function() {
	  							$('#guardarCambios').click(function() {

	  								var modelo = document.getElementById('modelo').value;
	  								var operacion = document.getElementById('operacionEdita').value;
	  								var descripcion = document.getElementById('descripcionEdita').value;
	  								var usarppms = $('#checkbox-h-5a').is(':checked');
	  								var grupo = document.getElementById('grupoEdita').value;

	  								/*alert('Modelo: ' + modelo + '\nOperacion: ' + operacion + '\nDescripcion: ' + descripcion + '\nUsarPPms: ' + usarppms + '\nGrupo: ' + grupo);*/

	  								$.getJSON("../getsJSON/set_operaciones_mod.php", {ajax: true, modelo: modelo, operacion: operacion, descripcion: descripcion, usarppms: usarppms, grupo: grupo, area: <?php echo "'$area'"; ?>}, function(j) {
										
										var tr = "";

										if (j[0] == 'default') {
											alert('No se encontraron Operaciones');
										} else if (j[0] == 'error') {
											alert('ERROR!!!\nAl intentar actualizar');
										}

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

										$('#checkbox-h-5a').checkboxradio('refresh', true);
										
										$("tbody#content_operaciones").html(tr);

										alert('Operacion editada correctamente');

										$('#cancelarEdicion').click();

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

      						<fieldset data-iconpos="right">
      							<input name="checkbox" id="checkbox-h-5a" type="checkbox" class="checkbox">
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
						</table>
					</div>
				</center>
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

			$('#popupAgregar').on({
				popupafterclose: function(event, ui) {
					document.getElementById('agregarOperacion').value = '';
					document.getElementById('agregarDescripcion').value = '';
					$('#checkbox-h-6c').prop('checked', false).checkboxradio('refresh');
					$('#agregarGrupo').val('Default').attr('selected', true).selectmenu("refresh");
				}
			});

			$('#popupCopiar').on({
				popupafterclose: function(event, ui) {
					$('#mod_origen').val('Default').attr('selected', true).selectmenu("refresh");
					$('#mod_destino').val('Default').attr('selected', true).selectmenu("refresh");
				}
			});
		});
	</script>
</body>
</html>