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
		<div id="divForm_Perm">
			<form method="post" action="config_permisos.php" data-ajax="false">
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
	          			<input type="submit" id="btnBuscar" name="btnBuscar" data-icon="search" data-inline="true" value="Buscar">
	          			<input type="submit" id="btnAgregar" name="btnAgregar" data-icon="plus" data-inline="true" value="Agregar">
	          			<input type="submit" id="btnModificar" name="btnModificar" data-icon="edit" data-inline="true" value="Modificar">
	          			<input type="submit" id="btnBorrar" name="btnBorrar" data-icon="delete" data-inline="true" value="Borrar">
	          			<input type="submit" id="btnCancelar" name="btnCancelar" data-icon="back" data-inline="true" value="Cancelar">
	          		</center>
	          	</fieldset>
			</form>
		</div>
	</div>
</body>
</html>