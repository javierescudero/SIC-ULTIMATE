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
		<div id="divForm_Des">
			<center>
				<form action="">
				<div class="ui-grid-a">
					<div class="ui-block-a">
						<label for="fecha"><b>Fecha Inicial</b></label>
						<div class="ui-field-contain" id="divFecha" title="Fecha Inicial">
            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<div id="selectFamilia_Des">
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
          			<div id="selectModelo_Des">
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
			<fieldset data-role="controlgroup" id="fieldSetGrpBtns_Des">
				<center>
					<a href="" data-role="button" id="btnCalcular" data-icon="check" data-inline="true">Calcular</a>
					<a href="" data-role="button" id="btnLimpiar" data-icon="refresh" data-inline="true">Limpiar</a>
				</center>
			</fieldset><br><br><br>
			<div class="ui-grid-b">
					<div class="ui-block-a">
						<label for="producidas"><b>Piezas Producidas</b></label>
						<input name="producidas" id="producidas" type="text" disabled/>
						<label for="rechazadas"><b>Piezas Rechazadas</b></label>
						<input name="rechazadas" id="rechazadas" type="text" disabled/>
					</div>
					<div class="ui-block-b">
						<label for="ppms"><b>PPMs</b></label>
						<input name="ppms" id="ppms" type="text" disabled/>
						<label for="rty"><b>RTY</b></label>
						<input name="rty" id="rty	" type="text" disabled/>
					</div>
					<div class="ui-block-c">
						<a href="" data-role="button" id="btnExcel" data-icon="grid" data-inline="true">Excel</a>
					</div>
				</div>
				<center>
				<div id="divTabla_Des">
						<table id="tabla_Des" cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr>
								<th width="280" align="left">Operacion</th>
								<th width="100" align="left">Produccion</th>
								<th width="100" align="left">Rezhazos</th>
								<th width="100" align="left">% Rezhazos</th>
								<th width="100" align="left">PPMs</th>
								<th width="100" align="left">FTY</th>
							</tr>
						</thead>
						<tbody>
							<!--Primer Dato (Para el 2do hay que cambiar el id y el for)-->
							<tr>
								<td><span>Acalidad</span></td>
								<td><span>0</span></td>
								<td><span>0</span></td>
								<td><span>0%</span></td>
								<td><span>0</span></td>
								<td><span>100%</span></td>
							</tr>
				</div>
			</center><br>
			</form>
			</center>
			
		</div>
	</div>
	<script type="text/javascript" src="../../js/js_tables.js"></script>
</body>
</html>