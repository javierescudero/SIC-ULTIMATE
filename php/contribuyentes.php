<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>SIC Ultimate</title>

	<script src="../js/jquery-1.12.4.min.js"></script>
	<script src="../js/jquery.mobile-1.4.5.js"></script>
	<script src="../js/jqm-datebox-1.4.5.core.min.js"></script>
	<script src="../js/jqm-datebox-1.4.5.mode.calbox.min.js"></script>
	<script src="../js/jqm-datebox.lang.utf8.js"></script>
	<script src="../js/js_refresh.js"></script>
	
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../css/jqm-datebox-1.4.5.min.css">
	<link rel="stylesheet" href="../css/css_style.css">
</head>
<body>
	<div data-role="page" data-theme="b" class="ui-responsive-panel">
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>SIC Ultimate<br> 
				<b>Contribuyentes</b>
			</h1>
		</div>

		<?php
			include("menu.php");
		?>

		<!-- Formulario -->
		<div id="divForm_Cont">
			<form action="">
				<center>
					<div class="ui-grid-a">
					<div class="ui-block-a">
						<label for="fecha"><b>Fecha Inicial</b></label>
						<div class="ui-field-contain" id="divFecha" title="Fecha Inicial">
            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<div id="selectFamilia_Cont">
          					<label for="familia"><b>Familia</b></label>
          					<select name="familia" id="familia">
								<option value="">--- Todas ---</option>
								<option value="">11E79</option>
								<option value="">36F</option>
								<option value="">48C21</option>
								<option value="">ATHENA</option>
							</select>
          				</div><br>
          				<label for="mostrar"><b>Mostrar top codigos</b></label>
          				<div class="ui-field-contain" id="divCodigos_Tend">
          					<input type="number" id="codigos">
          				</div>
					</div>
					<div class="ui-block-b">
						<label for="fecha"><b>Fecha Final</b></label>
						<div class="ui-field-contain" id="divFecha" title="Fecha Final">
            				<input name="fechaFinal" id="fechaFinal" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<div id="selectModelo_Cont">
          					<label for="modelo"><b>Modelo</b></label>
          					<select name="modelo" id="modelo">
								<option value="">--- Todos ---</option>
								<option value="">11E79 101B1</option>
								<option value="">11E79 301B1</option>
								<option value="">11E79 400B1</option>
								<option value="">11E79-901</option>
							</select>
          				</div><br>
          				<label for="cantidad"><b>Componentes</b></label>
          				<div class="ui-field-contain" id="divComponentes_Tend" data-role"inline">
          					<input type="number" id="cantComponentes_Tend" min="0">
          				</div>
					</div>
				</div>
				</center>
				
			<fieldset data-role="controlgroup" id="fieldSetBtns_Cont">
				<center>
					<a href="" data-role="button" id="btnCalcular" data-icon="check" data-inline="true">Calcular</a>
					<a href="" data-role="button" id="btnLimpiar" data-icon="refresh" data-inline="true">Limpiar</a>
				</center>
			</fieldset><br><br><br>
			<div id="divTablaCont">
				<center>
				<table id="tabla_Cont" cellpadding="0" cellspacing="0" border="0" class="display">
				<thead>
					<tr>
						<th width="110">Selec</th>
						<th width="500">Operacion</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td id="colSeleccion_Cont"><fieldset data-iconpos="right" id="fieldSeleccion">
								<label for="seleccion">Sel.</label>
								<input id="seleccion" name="seleccion" type="checkbox">
      						</fieldset></td>
						<td id="colOperacion"><span>Acalidad</span></td>
					</tr>
				</tbody>
			</table>
			</center>
			</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../js/js_tables.js"></script>
</body>
</html>