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
		#divContentModelo_Comp, #divContentComponentes {
			width: 50%;
		}
	}
</style>
<body>
	<?php
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
	?>
	<div data-role="page" data-theme="b" id="divPage">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Componentes<br>Components
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
		<div id="divFormComp">
			<form action="">

				<center>
					<div data-role="fieldcontain" id="divContentModelo_Comp">
						<center>
							<label for="modelos"><b>Modelo</b></label>
						</center>
						<select name="lista_modelos" id="lista_modelos">
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

				<!--Componentes-->
				<center>
					<div data-role="fieldcontain" id="divContentComponentes">

						<script type="text/javascript">
							$(function() {
								$("select#lista_modelos").change(function() {

									//Carga los componentes al seleccionar un modelo.
									$.getJSON("../getsJSON/get_componentes.php", {ajax: true, modelo: $(this).val(), area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="default">- - - Selecciona Un Componente - - -</option>\n';
										if (j[0] == '') {

										} else {
											for (var i = 0; i < j.length; i++) {
												options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';
											}
										}
										
										$("select#sel_componentes").html(options);
									});
								});

							});
						</script>

						<center>
							<label for="sel_componentes"><b>Componentes</b></label>
							<select name="sel_componentes" id="sel_componentes">
								<option value="default">- - - Selecciona Un Componente - - -</option>
							</select>
						</center>
					</div>
				</center>
				
				<!-- Botones -->
				<center>
					<div id="divBtnsComponentes_Comp">

						<script type="text/javascript">
							$(function() {
								
								//Agregar Componente
								$("a#agregarComponenteConfirmacion").click(function(){
									var valComponente = document.getElementById('agregarComponente').value;
									var valModelo = document.getElementById('lista_modelos').value;
									$.getJSON("../getsJSON/add_componentes.php", {ajax: true, modelo: valModelo, componente: valComponente, area: <?php echo "'$area'"; ?> }, function(j) {
										var options = '<option value="default">- - - Selecciona Un Componente - - -</option>\n';
										for (var i = 0; i < j.length; i++) {
											options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';
										}
										alert('Componente se agrego correctamente');
										$("select#sel_componentes").html(options);
										
										valFamilia = document.getElementById('agregarComponente').value = '';
										$('#cancelarAddComponentes').click();
									});
								});

							});
						</script>

						<!-- PopUp Agregar Componente -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupAgregar" id="btnAgregar" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    						<div data-role="popup" id="popupAgregar" class="ui-content">
      							<h3>Agregar Componente</h3><hr>
      							<input type="text" id="agregarComponente">
								<a id="agregarComponenteConfirmacion" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelarAddComponentes" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<script type="text/javascript">
							$(function() {
								
								//Eliminar Componente
								$("a#eliminarComponente").click(function(){
									var valComponente = document.getElementById('sel_componentes').value;
									var valModelo = document.getElementById('lista_modelos').value;

									if (valComponente == 'default') {
										alert('Selecciona Un Componente');
									} else {
										$.getJSON("../getsJSON/del_componente.php", {ajax: true, modelo: valModelo, componente: valComponente, area: <?php echo "'$area'"; ?> }, function(j) {
											alert('Componente = ' + valComponente);
											var options = '<option value="default">- - - Selecciona Un Componente - - -</option>\n';
											for (var i = 0; i < j.length; i++) {
												options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';
											}
											
											alert('Componente se elimino correctamente');
											$("select#sel_componentes").html(options);
											
										});
									}

									$('#cancelDelComponente').click();
								});

							});
						</script>

  						<!-- PopUp Eliminar Componente -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupEliminar" id="btnEliminar" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    						<div data-role="popup" id="popupEliminar" class="ui-content">
      							<h3>Eliminar Componente</h3><hr>
      							<p>Estas seguro de eliminar este <b>Componente</b>???</p>
      							<center>
									<a id="eliminarComponente" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
									<a id="cancelDelComponente" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
								</center>
    						</div>
  						</div>

  						<script type="text/javascript">
  							
  							//Copiar Componentes
							$(document).ready(function(){
								$("a#copiarComponentesCDD").click(function() { 
									var modeloOrigen = document.getElementById('mod_origen').value;
									var modeloDestino = document.getElementById('mod_destino').value;

									$.getJSON("../getsJSON/copy_componentes.php", {ajax: true, origen: modeloOrigen, destino: modeloDestino, area: <?php echo "'$area'"; ?>}, function(j) {
										var options = '<option value="default">- - - Selecciona Un Componente - - -</option>\n';
										for (var i = 0; i < j.length; i++) {
											options += '<option value="'+ j[i].Comp +'">'+ j[i].Comp +'</option> \n';

											}

											$("select#sel_componentes").html(options);
										});
									
									alert('Componentes Copiados');
									$("a#salirCopyComponentes").click();
								});
							});

	  					</script>

  						<!-- PopUp Copiar Componente-->
						<div data-role="main" class="ui-content">
    						<a href="#popupCopiar" id="btnCopia" data-rel="popup" class="ui-btn ui-icon-bars ui-btn-icon-left ui-btn-inline ui-corner">Copiar de . . .</a>
    						<div data-role="popup" id="popupCopiar" class="ui-content">
      							<h3>Copiar Componentes</h3><hr>
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
									<a id="copiarComponentesCDD" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
									<a id="salirCopyComponentes" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
								</center>
    						</div>
  						</div>

  						<!-- PopUp Importar Componentes-->
						<div data-role="main" class="ui-content">
    						<a href="#popupImportar" id="btnImporta" data-rel="popup" class="ui-btn ui-icon-action ui-btn-icon-left ui-btn-inline ui-corner">Importar</a>
    						<div data-role="popup" id="popupImportar" class="ui-content">
      							<h3>Importar Componentes</h3><hr>
								<div id="divModelo">
									<label for="modelo">Modelo</label>
									<input type="text">
								</div>
								<div id="divSelectHojas">
									<center><label for="hoja" data-theme="c"><b>Seleccione una hoja</b></label></center><br>
									<div id="listViewHojas">
										<ul data-role="listview">
											<li data-icon="false"><a href="">Aqui se cargan los archivos</li>
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
											<li data-icon="false"><a href="">Aqui aparecen las advertencias</li>
										</ul>
									</div>
								</div>
    						</div>
  						</div>

					</div>
				</center>

			</form>
		</div>
	</div>
</body>
</html>