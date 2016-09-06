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
		<!--Header-->
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>SIC Ultimate<br>
			<center>
				<img src="../public/images/Sicicon.ico">
			</center>
			</h1>
		</div>
		<?php
			include("menu.php");
		?>

		<div id="divForm_Reg">
			<form action="">
				<div class="ui-grid-b">
					<div class="ui-block-a">
						<label for="fecha"><b>Fecha</b></label>
						<div class="ui-field-contain" id="divFecha" title="Fecha">
            				<input name="fecha" id="fecha" type="text" data-role="datebox" data-options='{"mode":"calbox"}'/>
          				</div>
          				<div style="display:none">
            				<input name="langpicker" type="text" data-role="datebox" data-datebox-close-callback="changeLang" data-datebox-custom-data="langs" data-datebox-custom-head="Language" data-datebox-popup-position="window" data-datebox-override-custom-set="Choose" data-datebox-mode="customflip" id="langpicker" />
          				</div>
          				<label for="turno"><b>Turno</b></label>
          				<div class="ui-field-contain" id="divTurno_Reg">
          					<select name="turno" id="turno" data-role="slider" data-theme="b" data-track-theme="b">
                				<option value="1">1</option>
                				<option value="3">3</option>
        					</select>
          				</div>
          				<label for="linea"><b>Linea</b></label>
          				<div class="ui-field-contain" id="divNumLinea_Reg">
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
					</div>
					<div class="ui-block-b">
          				<label for="operacion"><b>Operacion</b></label>
          				<div class="ui-field-contain" id="divOperacion_Reg" title="Operaciones">
            				<select name="operacion" id="operacion">
								<option value="">CZ140</option>
								<option value="">Rfinal</option>
								<option value="">CZ020</option>
								<option value="">Acalidad</option>
								<option value="">RZenthel</option>
							</select>
          				</div>
          				<label for="familia"><b>Familia</b></label>
						<div class="ui-field-contain" id="divFamilia_Reg" title="Familias">
            				<select name="familia" id="familia">
								<option value="">11E79</option>
							</select>
          				</div>
          				<label for="familia"><b>Modelos</b></label>
						<div class="ui-field-contain" id="divModelo_Reg" title="Modelos">
            				<select name="modelo" id="modelo">
								<option value="">11E79</option>
								<option value="">36E</option>
								<option value="">36G - TWO STAGE</option>
								<option value="">36H</option>
								<option value="">50C51</option>
								<option value="">INTELLIVENT</option>
								<option value="">PANEL ASSY</option>
							</select>
          				</div>
					</div>
					<div class="ui-block-c">
						<label for="empleado"><b># de Empleado</b></label>
          				<div class="ui-field-contain" id="divEmpleado_Reg" title="Numero de Empleado">
            				<input name="empleado" id="empleado" type="number"/>
          				</div>
          				<label for="produccion"><b>Produccion</b></label>
          				<div class="ui-field-contain" id="divProduccion_Reg" title="Produccion">
            				<input name="produccion" id="produccion"/>
          				</div>
          				<label for="piezas"><b>Piezas Rechazadas</b></label>
          				<div class="ui-field-contain" id="divPzRechazadas_Reg" title="Piezas rechazadas">
            				<input name="piezas" id="piezas" type="number"/>
          				</div> 
					</div>
				</div>
				<center>
					<a href="" id="btnAgregaModelo" data-role="button" data-inline="true" onclick="window.open('fam&mod.html');">Agregar Modelos / Familia</a>
          			<a href="" id="btnAgregaComponente" data-role="button" data-inline="true" onclick="window.open('componentes.html');">Agregar Componentes</a>
          			<a href="" id="btnAgregaCodigo" data-role="button" data-inline="true" onclick="window.open('codigos_de_falla.html');">Agregar Codigos De Falla</a>
				</center><br>
				
				<!-- Tabla -->
				<center>
				<div id="divTabla_Reg">
						<table id="tabla_Reg" cellpadding="0" cellspacing="0" border="0" class="display">
						<thead>
							<tr>
								<th width="60" align="left">Codigo</th>
								<th width="280" align="left">Componente</th>
								<th width="130" align="left">Cantidad</th>
							</tr>
						</thead>
						<tbody>
							<!--Primer Dato (Para el 2do hay que cambiar el id y el for)-->
							<tr>
								<td>
									<select name="codigo" id="codigo">
										<option value="">- - - </option>
									</select>
								</td>
								<td>
									<select name="componente" id="componente">
										<option value="">- - -</option>
									</select>
								</td>
								<td><span>0</span></td>
							</tr>
				</div>
			</center>
				<center>
					<a href="" data-role="button" id="guardar" data-icon="check" data-inline="true">Guardar</a>
					<a href="" data-role="button" id="limpiar" data-icon="refresh" data-inline="true">Limpiar</a>
				</center><br>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../js/js_tables.js"></script>
</body>
</html>