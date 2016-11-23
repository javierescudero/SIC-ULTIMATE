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

		function cargaCodigos($conn, $database) {
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Codigo FROM codigos ORDER BY Codigo");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Codigo']."'>".$row['Codigo']."</option>";
			}
			mysqli_close($con);
		}

		function cargaRegistrarAs($conn, $database) {
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT RegistrarAs FROM codigos ORDER BY RegistrarAs");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['RegistrarAs']."'>".$row['RegistrarAs']."</option>";
			}
			mysqli_close($con);
		}

		function cargaDescripcion($conn, $database) {
			$con = mysqli_connect(SERVER, USER, PASSWORD, $database);
			$query = mysqli_query($con, "SELECT DISTINCT Descripcion FROM codigos ORDER BY Descripcion");
			$num_rows = mysqli_num_rows($query);
			while ($row = mysqli_fetch_assoc($query)) {
				echo "<option value='".$row['Descripcion']."'>".$row['Descripcion']."</option>";
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
						<select name="modelo" id="selectModelo_CD">
							<option>- - - Selecciona Un Modelo - - -</option>
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
							$(function() {
								
								//Agregar Codigos
								$("a#agregarCodigoConfirmacion").click(function(){
									var valCodigo = document.getElementById('agregarCodigo').value;
									alert('valCodigo = ' + valCodigo);
									var valregistrarComo = document.getElementById('registrarComo').value;
									alert('valregistrarComo = ' + valregistrarComo);
									var valDescripcion = document.getElementById('agregarDescripcion').value;
									alert('valDescripcion = ' + valDescripcion);
									var valModelo = document.getElementById('selectModelo_CD').value;
									alert('valModelo = ' + valModelo);

									$.getJSON("../getsJSON/add_Codigos.php", {ajax: true, modelo: valModelo, codigo: valCodigo, registrarAs: valregistrarComo, descripcion: valDescripcion,  area: <?php echo "'$area'"; ?> }, function(j) {
										var tr = "";
										for (var i = 0; i < j.length; i++) {

											tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
								
											tr += '<td><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

											tr += '<td><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

											tr += '<td><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

										}
										$("tbody#content_codigos").html(tr);

										valCodigo = document.getElementById('agregarCodigo').value = '';
										valregistrarComo = document.getElementById('registrarComo').value = '';
										valDescripcion = document.getElementById('agregarDescripcion').value = '';

										$('#cancelarAdd').click();

									});
								});

								$(document).ready(function(e) {
									//$("select#familias").change();
									$("select#modelos").change();
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
								$('tbody#content_codigos').click(function (e) {
									valCodigo = e.target.id;
								});

								//Eliminar Codigo
								$("a#eliminarCodigo").click(function(){
									//alert('valOperacion = ' + valOperacion);
									var valModelo = document.getElementById('selectModelo_CD').value;
									if (valModelo == 'default') {
										alert('Debes seleccionar algun modelo...');
										return false;
									}else {
										$.getJSON("../getsJSON/del_codigo.php", {ajax: true, modelo: valModelo, codigo: valCodigo, area: <?php echo "'$area'"; ?> }, function(j) {
											var tr = "";
											for (var i = 0; i < j.length; i++) {

												tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
								
												tr += '<td><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

												tr += '<td><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

												tr += '<td><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

											}
											$("tbody#content_codigos").html(tr);


										});
										alert('Codigo Eliminado');
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

  						<!-- PopUp Editar Codigos-->
						<div data-role="popup" id="popupEditarCodigo" class="ui-content">
							<label for="codigo">Codigo</label>
							<select name="codigo" id="codigo">
								<option value="default">- - - - - - -</option>
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


							<label for="registrarAs">Registrar Como</label>
							<select name="registrarAs" id="registrarAs">
								<option value="default">- - - - - - -</option>
								<?php
									if ($area == 'Electronica') {
										cargaRegistrarAs($con, 'Electronica');
									} elseif ($area == 'Electromecanicos') {
										cargaRegistrarAs($con, 'Electromecanicos');
									} elseif ($area == 'Valvulas') {
										cargaRegistrarAs($con, 'Valvulas');
									}
								?>
							</select>

							<label for="descripcion">Descripcion</label>
							<select name="descripcion" id="descripcion">
								<option value="default">- - - - - - -</option>
								<?php
									if ($area == 'Electronica') {
										cargaDescripcion($con, 'Electronica');
									} elseif ($area == 'Electromecanicos') {
										cargaDescripcion($con, 'Electromecanicos');
									} elseif ($area == 'Valvulas') {
										cargaDescripcion($con, 'Valvulas');
									}
								?>
							</select>
							<a id="guardarCambios" href="#" data-role="button" data-icon="check" data-inline="true">Guardar</a>
							<a id="cancelarEdicion" href="" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
						</div>

						<script type="text/javascript">
  							//Copiar Operaciones
							$(document).ready(function(){
								$("a#copiarCodigos").click(function() {
									var modeloOrigen = document.getElementById('mod_origen').value;
									var modeloDestino = document.getElementById('mod_destino').value;

									$.getJSON("../getsJSON/copy_codigos.php", {ajax: true, origen: modeloOrigen, destino: modeloDestino, area: <?php echo "'$area'"; ?>}, function(j) {
										var tr = "";
										for (var i = 0; i < j.length; i++) {
											
											tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
								
											tr += '<td><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

											tr += '<td><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

											tr += '<td><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';
										}

										$("tbody#tabla_CDF").html(tr);

									});
									alert('Codigos Copiados');
									
									$("a#cancelCopyCodigos").click();
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

  						<!-- PopUp Importar Codigos-->
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
  						</div>
					</div>
				</center>

				<script type="text/javascript">
					var flag = true;
					$("select#selectModelo_CD").change(function() {
						//Carga las operaciones al seleccionar un modelo.
						$.getJSON("../getsJSON/get_codigos.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
							var tr = "";
							for (var i = 0; i < j.length; i++) {

								tr += '<tr><td><fieldset data-iconpos="left"><input type="checkbox" id="'+j[i].Codigo+'"><label></label></fieldset></td>';
								
								tr += '<td><span id="'+j[i].Codigo+'" ><a id="'+j[i].Codigo+'" class="ui-btn" href="#popupEditarCodigo" data-rel="popup">' +j[i].Codigo+ '</a></span></td>';

								tr += '<td><span id="'+j[i].RegistrarAs+'" ><a id="'+j[i].RegistrarAs+'" class="ui-btn" data-rel="popup">' +j[i].RegistrarAs+ '</a></span></td>';

								tr += '<td><span id="'+j[i].Descripcion+'" ><a id="'+j[i].Descripcion+'" class="ui-btn" data-rel="popup">' +j[i].Descripcion+ '</a></span></td></tr>';

							}
							
							$("tbody#content_codigos").html(tr);
						});
					});
				</script>

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
								<tr>
								</tr>
							</tbody>
						</table>
					</div>
			</center>
			</form>
		</div>
	</div>
</body>
</html>