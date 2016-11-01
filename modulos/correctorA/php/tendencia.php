<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>SIC Ultimate</title>

	<script src="../../../js/jquery-1.12.4.min.js"></script>
	<script src="../../../js/jquery.mobile-1.4.5.js"></script>
	<script src="../../../js/jqm-datebox-1.4.5.core.min.js"></script>
	<script src="../../../js/jqm-datebox-1.4.5.mode.calbox.min.js"></script>
	<script src="../../../js/jqm-datebox.lang.utf8.js"></script>
	<script src="../../../js/js_refresh.js"></script>
	
	<link rel="stylesheet" href="../../../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../../../css/jqm-datebox-1.4.5.min.css">
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
		<div id="divForm_Tend">

			<form action="">
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<label for="fecha"><b>Fecha Inicial</b></label>
						<div class="ui-field-contain" id="divFecha" title="Fecha Inicial">
            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<div id="selectFamilia_Tend">
          					<label for="familia"><b>Familia</b></label>
          					<select name="familia" id="familia">
								<option value="">--- Todas ---</option>
								<option value="">11E79</option>
								<option value="">36F</option>
								<option value="">48C21</option>
								<option value="">ATHENA</option>
							</select>
          				</div>
					</div>
					<div class="ui-block-b">
						<label for="fecha"><b>Fecha Final</b></label>
						<div class="ui-field-contain" id="divFecha" title="Fecha Final">
            				<input name="fechaFinal" id="fechaFinal" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<div id="selectModelo_Tend">
          					<label for="modelo"><b>Modelo</b></label>
          					<select name="modelo" id="modelo">
								<option value="">--- Todos ---</option>
								<option value="">11E79 101B1</option>
								<option value="">11E79 301B1</option>
								<option value="">11E79 400B1</option>
								<option value="">11E79-901</option>
							</select>
          				</div>
					</div>
				</div><br>
				<div class="containing-element" id="divFlipDatos_Tend">
					<label for="flipDatos_Tend" id="lblMostrar_Tend"><b>Mostrar Datos</b></label>
					<select name="flipDatos_Tend" id="flipDatos_Tend" data-role="slider">
						<option value="0">Acumulados</option>
						<option value="1">Diarios</option>
					</select>
				</div>
				<fieldset data-role="controlgroup" id="fieldSetBtns_Tend">
					<a href="" data-role="button" id="btnCalcular" data-icon="check" data-inline="true">Calcular</a>
					<a href="" data-role="button" id="btnLimpiar" data-icon="refresh" data-inline="true">Limpiar</a>
				</fieldset><br><br><br>
				
					<div id="divTabla_Tend"></div>
						<table id="tabla_Tend" cellpadding="0" cellspacing="0" border="0" class="display">
							<thead>
								<tr>
									<th width="110">Selec</th>
									<th width="500">Operacion</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td id="colSeleccion_Tend">
										<fieldset data-iconpos="right" id="fieldSeleccion">
											<label for="seleccion">Sel.</label>
											<input id="seleccion" name="seleccion" type="checkbox">
      									</fieldset></td>
									<td id="colOperacion"><span>Acalidad</span></td>
								</tr>
							</tbody>
						</table>
					</div>	
				
			</form>
			
	</div>
	<script type="text/javascript" src="../../../js/js_tables.js"></script>
</body>
</html>