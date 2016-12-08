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

	<?php include("../../php/librerias.php"); ?>
</head>
<body>
	<div data-role="page" data-theme="b" class="ui-responsive-panel">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Permisos<br>Permissions
				<!--<center>
					<img src="../../public/images/Sicicon.ico">
				</center>-->
			</h1>
		</div>
		<?php
			 include("../menus/menu_administrador.php");
		?>

		<!-- Formulario -->
		<div id="divForm_Perm">
			<form>

				<div class="ui-field-contain" id="divUserPassword">
	            	<input name="usuario" id="usuario" type="text" placeholder="Usuario"/>
	            	<input name="password" id="password" type="password" placeholder="Password"/>
	            	<label for="flip-1"><b>Cambiar Password:</b></label>
	       			<select name="flip-1" id="flip-1" data-role="slider" data-theme="b" data-track-theme="b">
	                	<option value="no">No</option>
	                	<option value="si">Si</option>
	        		</select>
	          	</div><br>
	          	<div class="ui-grid-b">
	          		<div class="ui-block-a">
	          			<label for="captura"><b>Captura</b></label><hr>
						<fieldset data-role="controlgroup">
		  					<input type="checkbox" name="checkModelos" id="checkModelos" class="custom" />
		   					<label for="checkModelos">Modelos / Familias</label>
		   					<input type="checkbox" name="checkOperaciones" id="checkOperaciones" class="custom" />
		   					<label for="checkOperaciones">Operaciones</label>
		   					<input type="checkbox" name="checkComponentes" id="checkComponentes" class="custom" />
		   					<label for="checkComponentes">Componentes</label>
		   					<input type="checkbox" name="checkCodigos" id="checkCodigos" class="custom" />
		   					<label for="checkCodigos">Codigos de Falla</label>
		   					<input type="checkbox" name="checkRegistros" id="checkRegistros" class="custom" />
		   					<label for="checkRegistros">Registros</label>
		   					<input type="checkbox" name="checkUsuarios" id="checkUsuarios" class="custom" />
		   					<label for="checkUsuarios">Usuarios</label>
	    				</fieldset>
	          		</div>
	          		<div class="ui-block-b">
	          			<label for="reportes"><b>Reportes</b></label><hr>
	          			<fieldset data-role="controlgroup">
		  					<input type="checkbox" name="checkDesempeno" id="checkDesempeno" class="custom" />
		   					<label for="checkDesempeno">Desempeño del Producto</label>
		   					<input type="checkbox" name="checkTendencia" id="checkTendencia" class="custom" />
		   					<label for="checkTendencia">Graficas de Tendencia</label>
		   					<input type="checkbox" name="checkContribuyentes" id="checkContribuyentes" class="custom" />
		   					<label for="checkContribuyentes">Contribuyentes</label>
		   					<input type="checkbox" name="checkCorreccion" id="checkCorreccion" class="custom" />
		   					<label for="checkCorreccion">Correciòn de Datos</label>
	    				</fieldset>
	          		</div>
	          		<div class="ui-block-c">
	          			<label for="area"><b>Area</b></label><hr>
	          			<fieldset data-role="controlgroup">
		  					<input type="checkbox" name="checkElectronica" id="checkElectronica" class="custom" />
		   					<label for="checkElectronica">Electronica</label>
		   					<input type="checkbox" name="checkElectromecanicos" id="checkElectromecanicos" class="custom" />
		   					<label for="checkElectromecanicos">Electromecanicos</label>
		   					<input type="checkbox" name="checkValvulas" id="checkValvulas" class="custom" />
		   					<label for="checkValvulas">Valvulas</label>
	    				</fieldset>
	          		</div>
	          	</div><br>
	          	<fieldset data-role="controlgroup">
	          		<center>
	          			<script type="text/javascript">
	          				$(document).ready(function() {

		          				$('#btnAgregar').click(function() {
		          					var usuario = document.getElementById('usuario').value;
		          					var password = document.getElementById('password').value;
		          					var camb_password = document.getElementById('flip-1').value; //si o no
		          					
		          					var checkModelos = document.getElementById('checkModelos').checked; //true or false
		          					var checkOperaciones = document.getElementById('checkOperaciones').checked;
		          					var checkComponentes = document.getElementById('checkComponentes').checked;
		          					var checkCodigos = document.getElementById('checkCodigos').checked;
		          					var checkRegistros = document.getElementById('checkRegistros').checked;
		          					var checkUsuarios = document.getElementById('checkUsuarios').checked;

		          					var checkDesempeno = document.getElementById('checkDesempeno').checked;
		          					var checkTendencia = document.getElementById('checkTendencia').checked;
		          					var checkContribuyentes = document.getElementById('checkContribuyentes').checked;
		          					var checkCorreccion = document.getElementById('checkCorreccion').checked;

		          					var checkElectronica = document.getElementById('checkElectronica').checked;
		          					var checkElectromecanicos = document.getElementById('checkElectromecanicos').checked;
		          					var checkValvulas = document.getElementById('checkValvulas').checked;

		          					if (usuario == '' || password == '') {
		          						alert('Ingresar usuario y password');
		          					} else if (!checkElectronica && !checkElectromecanicos && !checkValvulas) {
		          						alert('Selecciona al menos un area');
		          					} else {
			          					$.getJSON("../getsJSON/add_user.php", {ajax: true, usuario: usuario, password: password, cambiar: camb_password, modelos: checkModelos, operaciones: checkOperaciones, componentes: checkComponentes, codigos: checkCodigos, registros: checkRegistros, usuarios: checkUsuarios, desempeno: checkDesempeno, tendencia: checkTendencia, contribuyentes: checkContribuyentes, correccion: checkCorreccion, electronica: checkElectronica, electromecanicos: checkElectromecanicos, valvulas: checkValvulas}, function(j) {

			          						if (j[0] == 'existe') {
			          							alert('Usuario Existe');
			          							document.getElementById('usuario').value = '';
			          							document.getElementById('password').value = '';
			          							document.getElementById('checkModelos').checked = 'false';
			          						} else if (j[0] == 'otro') {
			          							alert('Este usuario no cuenta con algun perfil.\nContacte al administrador del sistema.');
			          						} else if (j[0] == 'exito'){
			          							alert('Se agrego usuario correctamente');
			          							document.getElementById('usuario').value = '';
			          							document.getElementById('password').value = '';
			          							document.getElementById('checkModelos').checked = false;
					          					document.getElementById('checkOperaciones').checked;
					          					document.getElementById('checkComponentes').checked;
					          					document.getElementById('checkCodigos').checked;
					          					document.getElementById('checkRegistros').checked;
					          					document.getElementById('checkUsuarios').checked;
					          					document.getElementById('checkDesempeno').checked;
					          					document.getElementById('checkTendencia').checked;
					          					document.getElementById('checkContribuyentes').checked;
					          					document.getElementById('checkCorreccion').checked;

					          					document.getElementById('checkElectronica').checked = false;
					          					document.getElementById('checkElectromecanicos').checked = false;
					          					document.getElementById('checkValvulas').checked = false;
			          						}
										});
		          					}


		          				});

	          				});
	          			</script>

	          			<input type="button" id="btnAgregar" name="btnAgregar" data-icon="plus" data-inline="true" value="Agregar">

	          			<script type="text/javascript">
	          				$(document).ready(function() {

		          				$('#btnBorrar').click(function() {
		          					var usuario = document.getElementById('usuario').value;
		          					var password = document.getElementById('password').value;

		          					if (usuario == '' || password == '') {
		          						alert('Ingresar usuario y password');
		          					} else {
			          					$.getJSON("../getsJSON/del_user.php", {ajax: true, usuario: usuario, password: password}, function(j) {

			          						if (j[0] == 'eliminado') {
			          							alert('El usuario se elimino');
			          							document.getElementById('usuario').value = '';
			          							document.getElementById('password').value = '';
			          						} else if (j[0] == 'error') {
			          							alert('ERROR !!!\nOcurrio un error al intentar eliminar al usuario.');
			          							document.getElementById('usuario').value = '';
			          							document.getElementById('password').value = '';
			          						} else if (j[0] == 'noencontrado'){
			          							alert('El usuario no se encuentra en la base de datos');
			          							document.getElementById('usuario').value = '';
			          							document.getElementById('password').value = '';
			          						}

										});
		          					}


		          				});

	          				});
	          			</script>

	          			<input type="button" id="btnBorrar" name="btnBorrar" data-icon="delete" data-inline="true" value="Borrar">

	          			<script type="text/javascript">
	          				$(document).ready(function() {
		          				$('#btnBuscar').click(function() {
		          					alert('Boton buscar');
		          				});
	          				});
	          			</script>
	          			
	          			<input type="button" id="btnBuscar" name="btnBuscar" data-icon="search" data-inline="true" value="Buscar">

	          			<script type="text/javascript">
	          				$(document).ready(function() {
		          				$('#btnModificar').click(function() {
		          					alert('Boton modificar');
		          				});
	          				});
	          			</script>
	          			
	          			<input type="button" id="btnModificar" name="btnModificar" data-icon="edit" data-inline="true" value="Modificar">

	          			<script type="text/javascript">
	          				$(document).ready(function() {
		          				$('#btnCancelar').click(function() {
		          					alert('Boton cancelar');
		          				});
	          				});
	          			</script>

	          			<input type="button" id="btnCancelar" name="btnCancelar" data-icon="back" data-inline="true" value="Cancelar">
	          		</center>
	          	</fieldset>
			</form>
		</div>
	</div>
</body>
</html>