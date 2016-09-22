<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>SIC Ultimate</title>

	<script src="../../../js/js_refresh.js"></script>
	<script src="../../../js/jquery-1.12.4.min.js"></script>
	<script src="../../../js/jquery.mobile-1.4.5.js"></script>
	
	<link rel="stylesheet" href="../../../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../../../css/css_style.css">
</head>
<body>
	<div data-role="page" data-theme="b" class="ui-responsive-panel">
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>SIC Ultimate<br>
			<center>
				<img src="../../../public/images/Sicicon.ico">
			</center>
			</h1>
		</div>
		<?php
			include("menu.php");
		?>

		<!-- Formulario -->
		<div id="divForm_Perm">
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
          			<a href="" data-role="button" id="btnAgregar" data-icon="plus" data-inline="true">Agregar</a>
					<a href="" data-role="button" id="btnModificar" data-icon="edit" data-inline="true">Modificar</a>
					<a href="" data-role="button" id="btnBorrar" data-icon="delete" data-inline="true">Borrar</a>
					<a href="" data-role="button" id="btnCancelar" data-icon="back" data-inline="true">Cancelar</a>
          		</center>
          	</fieldset>
		</div>
	</div>
</body>
</html>