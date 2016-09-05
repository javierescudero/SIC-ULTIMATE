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
				<b>Correccion de Datos</b>
			</h1>
		</div>

		<?php
			include("menu.php");
		?>

		<!-- Formulario -->
		<center>
			<div id="divForm_CDD">
			<form action="">
				<div class="ui-grid-b">
					<div class="ui-block-a">
						<label for="fecha"><b>Fecha Inicial</b></label>
						<div class="ui-field-contain" id="divFechaInicial_CDD" title="Fecha Inicial">
            				<input name="fechaInicial" id="fechaInicial" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<label for="familia"><b>Familia</b></label>
          				<div class="ui-field-contain" id="divFamilia_CDD">
          					<select name="familia" id="familia">
								<option value="">--- Todas ---</option>
								<option value="">11E79</option>
								<option value="">36F</option>
								<option value="">48C21</option>
								<option value="">ATHENA</option>
							</select>
          				</div>
          				<label for="componente"><b>Componente</b></label>
          				<div class="ui-field-contain" id="divComponente_CDD">
          					<select name="componente" id="componente">
								<option value="">--- Todos ---</option>
								<option value="">01</option>
								<option value="">03</option>
								<option value="">06</option>
							</select>
          				</div>
					</div>
					<div class="ui-block-b">
						<label for="fecha"><b>Fecha Final</b></label>
						<div class="ui-field-contain" id="divFechaFinal_CDD" title="Fecha Final">
            				<input name="fechaFinal" id="fechaFinal" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<label for="modelo"><b>Modelo</b></label>
          				<div class="ui-field-contain" id="divModelo_CDD">
          					<select name="modelo" id="modelo">	
								<option value="">--- Todos ---</option>
								<option value="">11E79 101B1</option>
								<option value="">11E79 301B1</option>
								<option value="">11E79 400B1</option>
								<option value="">11E79-901</option>
							</select>
          				</div>
          				<label for="operaciones"><b>Operaciones</b></label>
          				<div class="ui-field-contain" id="divOperaciones_CDD">
          					<select name="operaciones" id="operaciones">
								<option value="">--- Todas ---</option>
								<option value="">Acalidad</option>
								<option value="">CY140</option>
								<option value="">CY999</option>
							</select>
          				</div>
					</div>
					<div class="ui-block-c">
						<label for="codigo"><b>Codigo</b></label>
						<div class="ui-field-contain" id="divCodigos_CDD">
          					<select name="codigo" id="codigo">
								<option value="">--- Todos ---</option>
								<option value="">10</option>
								<option value="">100</option>
								<option value="">1000</option>
							</select>
          				</div>
          				<label for="linea"><b>Linea</b></label>
          				<div class="ui-field-contain" id="divSelectLinea_CDD">
          					<select name="linea" id="Linea">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
								<option value="6">6</option>
								<option value="7">7</option>
								<option value="8">8</option>
								<option value="9">9</option>
								<option value="10">10</option>
							</select>
          				</div>
          				<label for=""><b>Turno</b></label>
          				<div class="ui-field-contain">
          					<select name="turno" id="turno " data-role="slider" data-theme="b" data-track-theme="b">
                				<option value="1">1</option>
                				<option value="3">3</option>
        					</select>
          				</div>
					</div>
				</div>
				<div class="ui-field-contain">
					<center>
						<a href="" id="btnMostrar" data-role="button" data-inline="true">Mostar</a>
						<a href="" id="btnActualizar" data-role="button" data-inline="true">Actualizar</a>
						<a href="" id="btnLimpiar" data-role="button" data-inline="true">Limpiar</a>
					</center>
				</div>
				<center>
					<div id="divTabla_CDD">
				<table id="tabla_CDD" cellpadding="0" cellspacing="0" border="0" class="display">
					<thead>
						<tr>
							<th width="15" align="left">Fecha</th>
							<th width="10" align="left">Turno</th>
							<th width="10" align="left">Linea</th>
							<th width="20" align="left">Empleado</th>
							<th width="30" align="left">Modelo</th>
							<th width="30" align="left">Operacion</th>
							<th width="10" align="left">Cantidad</th>
							<th width="20" align="left">Codigo</th>
							<th width="30" align="left">Componente</th>
							<th width="30" align="left">Produccion</th>
							<th width="30" align="left">Familia</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><span>8/01/2016</span></td>
							<td><span>1</span></td>
							<td><span>5</span></td>
							<td><span>51168</span></td>
							<td><span>11E79 101B1</span></td>
							<td><span>Acalidad</span></td>
							<td><span>7</span></td>
							<td><span>1000</span></td>
							<td><span>06</span></td>
							<td><span>54</span></td>
							<td><span>11E79</span></td>
						</tr>
					</tbody>
				</table>
			</div>
				</center>
			</form>
			
		</div>
		</center>
	</div>
	<script type="text/javascript" src="../js/js_tables.js"></script>
</body>
</html>