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
	@media screen and (min-width: 480px) {

	}
	@media screen and (max-width: 1800px) {
		#divTabla_CDF {
			width: 90%;
			max-height: 370px;
		}
		#divContentModelo_CDF {
			width: 35%;
		}

		.ui-page-theme-f {
		    font-weight: bold;
		    background-color: green;
		}
	}
</style>
<body>
	<?php
		function cargaModelos($conn, $database) {
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT Modelo FROM modelos ORDER BY Modelo");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Modelo']."'>".$row['Modelo']."</option>";
			}
			mysqli_close($con);
		}
	?>
	<div data-role="page" data-theme="b" id="divPage">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Codigos De Falla<br>Fault Codes
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
		<div id="divForm_CDF">

			<form action="">
				<center>
					<div data-role="fieldcontain" id="divContentModelo_CDF">
						<center>
							<label for="modelo"><b>Modelo</b></label>
						</center>
						<select id="selectModelo_CD">
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
					<div id="divBotonesCodigos">

						<script type="text/javascript">

							$("select#selectModelo_CD").change(function() {

								//Carga los codigos al seleccionar un modelo.
								$.getJSON("../getsJSON/get_codigos.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
									var tr = "";
									if (j[0] == '') {
									} else {
										for (var i = 0; i < j.length; i++) {
											tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
											
											tr += '<td class="codigo"><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

											tr += '<td class="registrarAs"><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

											tr += '<td class="descripcion"><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

										}
									}
									
									$("tbody#content_codigos").html(tr);
								});
							});

						</script>

						<script type="text/javascript">
							$(function() {
								
								//Agregar Codigos
								$("#agregarCodigoConfirmacion").click(function(){

									var valCodigo = document.getElementById('agregarCodigo').value;
									var valregistrarComo = document.getElementById('registrarComo').value;
									var valDescripcion = document.getElementById('agregarDescripcion').value;
									var valModelo = document.getElementById('selectModelo_CD').value;

									if (valModelo == 'Default') {
										alert('Debes seleccionar un modelo');
									} else {

										$.getJSON("../getsJSON/add_Codigos.php", {ajax: true, modelo: valModelo, codigo: valCodigo, registrarAs: valregistrarComo, descripcion: valDescripcion,  area: <?php echo "'$area'"; ?> }, function(j) {

											var tr = "";

											if (j[0] == 'noencontrada') {
												alert('No se encontro familia');
											} else if (j[0] == 'noencontrado') {
												alert('No se encontro modelo');
											} else if (j[0] == 'existe') {
												alert('Operacion ya existe');
											} else if (j[0] == 'error') {
												alert('ERROR!!!\nAl agregar codigo');
											}  else {

												for (var i = 0; i < j.length; i++) {

													tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
										
													tr += '<td class="codigo"><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

													tr += '<td class="registrarAs"><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

													tr += '<td class="descripcion"><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

												}
												$("#content_codigos").html(tr);

												valCodigo = document.getElementById('agregarCodigo').value = '';
												valregistrarComo = document.getElementById('registrarComo').value = '';
												valDescripcion = document.getElementById('agregarDescripcion').value = '';

												alert('codigo agregado');

												$('#cancelarAdd').click();
											}


										});
										
									}

								});

							});
						</script>

						<!-- PopUp Agregar Codigos -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupAgregar" id="btnAgregar" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    						<div data-role="popup" id="popupAgregar" class="ui-content">
      							<label for="codigo">Codigo</label>
      							<input type="text" id="agregarCodigo">
      							<label for="registrar">Registrar como</label>
      							<input type="text" id="registrarComo">
      							<label for="descripcion">Descripcion</label>
      							<input type="text" id="agregarDescripcion">
								<a id="agregarCodigoConfirmacion" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelarAdd" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<script type="text/javascript">
							$(function() {
								
								var valCodigo;
								$('#content_codigos').click(function (e) {
									valCodigo = e.target.id;
								});

								//Eliminar Codigo
								$("#eliminarCodigo").click(function(){
									var valModelo = document.getElementById('selectModelo_CD').value;
									if (valModelo == 'Default') {
										alert('Debes seleccionar algun modelo...');
										return false;
									}else {
										$.getJSON("../getsJSON/del_codigo.php", {ajax: true, modelo: valModelo, codigo: valCodigo, area: <?php echo "'$area'"; ?> }, function(j) {
											var tr = "";
											if (j[0] == '') {
											} else {
												for (var i = 0; i < j.length; i++) {

													tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
									
													tr += '<td class="codigo"><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

													tr += '<td class="registrarAs"><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

													tr += '<td class="descripcion"><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

												}
											}

											$("#content_codigos").html(tr);

											alert('Codigo eliminado');

										});

										$('#salirDel').click();
									}
								});
							});
						</script>

  						<!-- PopUp Eliminar Codigos -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupEliminar" id="btnEliminar" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    						<div data-role="popup" id="popupEliminar" class="ui-content">
      							<h3>Eliminar Codigo</h3><hr>
      							<p>Estas seguro de eliminar este <b>Codigo</b>???</p>
      							<center>
									<a id="eliminarCodigo" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
									<a id="salirDel" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
								</center>
    						</div>
  						</div>

						<script type="text/javascript">
  							//Copiar codigos
							$(document).ready(function(){
								$("a#copiarCodigos").click(function() {
									var modeloOrigen = document.getElementById('mod_origen').value;
									var modeloDestino = document.getElementById('mod_destino').value;

									$.getJSON("../getsJSON/copy_codigos.php", {ajax: true, origen: modeloOrigen, destino: modeloDestino, area: <?php echo "'$area'"; ?>}, function(j) {
										var tr = "";

										if (j[0] == 'error') {
											alert('ERROR!!!\nProblema al copiar codigos');
										} else if (j[0] == 'noencontrados'){
											alert('No se encontraron codigos');
										} else {

											for (var i = 0; i < j.length; i++) {
												
												tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
									
												tr += '<td class="codigo"><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

												tr += '<td class="registrarAs"><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

												tr += '<td class="descripcion"><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';
											}

											$("#content_codigos").html(tr);

											$('#mod_origen').val('Default').attr('selected', true).selectmenu("refresh");
											$('#mod_destino').val('Default').attr('selected', true).selectmenu("refresh");

											alert('Codigos copiados');

											$("#cancelCopyCodigos").click();
										}

									});
									
								});
							});
	  					</script>

  						<!-- PopUp Copiar Codigos-->
						<div data-role="main" class="ui-content">
    						<a href="#popupCopiar" id="btnCopia" data-rel="popup" class="ui-btn ui-icon-bars ui-btn-icon-left ui-btn-inline ui-corner">Copiar</a>
    						<div data-role="popup" id="popupCopiar" class="ui-content">
      							<h3>Copiar Codigos de Falla</h3><hr>
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
									<a id="copiarCodigos" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
									<a id="cancelCopyCodigos" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
								</center>
    						</div>
  						</div>

  						<!-- PopUp Importar Codigos
						<div data-role="main" class="ui-content">
    						<a href="#popupImportar" id="btnImporta" data-rel="popup" class="ui-btn ui-icon-action ui-btn-icon-left ui-btn-inline ui-corner">Importar</a>
    						<div data-role="popup" id="popupImportar" class="ui-content">
      							<h3>Importar Codigos de Falla</h3><hr>
								<div id="divModelo">
									<label for="modelo">Modelo</label>
									<input type="text">
								</div>
								<div id="divSelectHojas">
									<center><label for="hoja" data-theme="c"><b>Seleccione una hoja</b></label></center><br>
									<div id="listViewHojas">
										<ul data-role="listview">
											<li data-icon="false"><a href="">Aqui se cargan los archivos</a></li>
										</ul><hr>
									</div>
								</div><br>
      							<center>
									<a id="abrirDoc" href="#" data-role="button" data-icon="bullets" data-inline="true">Abrir Documento</a>
									<a id="importar" href="#" data-role="button" data-icon="action" data-inline="true">Importar</a>
								</center><br>
								<div id="divSelecAdvertencias">
									<center><label for="advertencia" data-theme="c"><b>Advertencias</b></label></center><br>
									<div id="listViewAdvertencias">
										<ul data-role="listview">
											<li data-icon="false"><a href="">Aqui aparecen las advertencias</a></li>
										</ul>
									</div>
								</div>
    						</div>
  						</div>-->

  						<script type="text/javascript">
	  						$(document).ready(function() {
	  							$('#guardarCambios').click(function() {

	  								var modelo = document.getElementById('selectModelo_CD').value;
	  								var codigo = document.getElementById('editarOperacion').value;
	  								var registrarAs = document.getElementById('editarRegistrarComo').value;
	  								var descripcion = document.getElementById('editarDescripcion').value;

	  								/*alert('Modelo: ' + modelo + '\nCodigo: ' + codigo + '\nRegistrarAs: ' + registrarAs + '\nDescripcion: ' + descripcion);*/

	  								$.getJSON("../getsJSON/set_codigos.php", {ajax: true, modelo: modelo, codigo: codigo, registrarAs: registrarAs, descripcion: descripcion, area: <?php echo "'$area'"; ?>}, function(j) {
										
										var tr = "";

										if (j[0] == 'default') {
											alert('No se encontraron Codigos');
										} else if (j[0] == 'error') {
											alert('ERROR!!!\nAl intentar actualizar');
										} else {

											for (var i = 0; i < j.length; i++) {
												
												tr += '<tr><td class="checkSelec"><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
											
												tr += '<td class="codigo"><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

												tr += '<td class="registrarAs"><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

												tr += '<td class="descripcion"><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

											}
											
											$("#content_codigos").html(tr);
											
											$("#cancelarEdicion").click();
										}

									});
	  							});
	  						});
	  					</script>

  						<!-- PopUp Editar Codigos-->
						<div data-role="popup" id="popupEditarCodigo" class="ui-content">
							<label for="codigo">Codigo</label>
							<input type="text" id="editarOperacion" disabled>

							<label for="registrarAs">Registrar Como</label>
							<input type="text" id="editarRegistrarComo">

							<label for="descripcion">Descripcion</label>
							<input type="text" id="editarDescripcion">

							<a id="guardarCambios" href="#" data-role="button" data-icon="check" data-inline="true">Guardar</a>
							<a id="cancelarEdicion" href="" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
						</div>

					</div>
				</center>

				<center>
					<div id="divTabla_CDF">
						<table id="tabla_CDF" cellpadding="0" cellspacing="0" border="0" class="display">
							<thead>
								<tr>
									<th width="100" align="left">Selec</th>
									<th width="100" align="left">Codigo</th>
									<th width="250" align="left">Registrar como</th>
									<th width="450" align="left">Descripcion</th>
								</tr>
							</thead>
							<tbody id="content_codigos">
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

			$("#popupEditarCodigo").on({
				popupafteropen: function(event, ui) {
					$(event.currentTarget).find('#editarOperacion').val(btn1);
					$(event.currentTarget).find('#editarRegistrarComo').val(btn2);
					$(event.currentTarget).find('#editarDescripcion').val(btn3);
				}
			});

			$("#content_codigos").on("click", "td:nth-of-type(2)", function() {
				
				btn1 = $(this).children('span').children('a').attr('id');

				btn2 = $(this).siblings('.registrarAs').children('span').attr('id');

				btn3 = $(this).siblings('.descripcion').children('span').attr('id');

			});

			$('#popupAgregar').on({
				popupafterclose: function(event, ui) {
					document.getElementById('agregarCodigo').value = '';
					document.getElementById('registrarComo').value = '';
					document.getElementById('agregarDescripcion').value = '';
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