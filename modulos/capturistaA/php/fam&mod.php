<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<title>SIC Ultimate</title>

	<script src="../../../js/jquery-1.12.4.min.js"></script>
	<script src="../../../js/jquery.mobile-1.4.5.js"></script>
	<script src="../../../js/js_refresh.js"></script>
	
	<link rel="stylesheet" href="../../../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../../../css/css_style.css">
</head>
<body>
	<div data-role="page" data-theme="b" id="divPage">
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
		<div id="divForm_FM">
			<form action="">
			<div class="ui-grid-d">
				
				<!-- Familias -->
				<div class="ui-block-a">
					<center><label for="divFamilia_FM" id="lblFamilia" data-theme="c"><b>Familias</b></label></center>
					<div id="divFamilia_FM">
						<ul data-role="listview" id="listFamilia">
							<li data-icon="false"><a href="">11E79</a></li>
						</ul>
					</div>
				</div>
				<div class="ui-block-b" id="divBtnsFamilias_FM">
					<br><br><br><br><br><br><br><br><br>

					<!-- PopUp Agregar Familia-->
					<div data-role="main" class="ui-content">
    					<a href="#popupAgregarFamilia" id="btnAgregarFam" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    					<div data-role="popup" id="popupAgregarFamilia" class="ui-content">
      						<h3>Agregar Familia</h3>
      						<input type="text" id="pop_inputAgregaFamilia" placeholder="Familia...">
      						<center>
								<a id="agregarFamilia" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelarAgregarFamilia" href="" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
							</center>
    					</div>
  					</div>

  					<!-- PopUp Elimnar Familia-->
  					<div data-role="main" class="ui-content">
    					<a href="#popupEliminarFamilia" id="btnAgregarFam" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    					<div data-role="popup" id="popupEliminarFamilia" class="ui-content">
      						<h3>Eliminar Familia</h3>
      						<p>Estas seguro de eliminar esta <b>Familia</b>???<br>
      							Esta familia contiene modelos.</p>
      						<center>
								<a id="eliminarFamilia" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
								<a id="salir" href="" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
							</center>
    					</div>
  					</div>
				</div>
				<div class="ui-block-c">
					<!-- Modelos -->
					<center><label for="divModelos_FM" id="lblModelos" data-theme="c"><b>Modelos</b></label></center>
					<div id="divModelos_FM">
						<ul data-role="listview" id="listModelos">
							<li data-icon="false"><a href="">11E79 101B1</a></li>
						</ul>
					</div>
				</div>
				<div class="ui-block-d" id="divBtnsModelos_FM">
					<br><br><br><br><br><br><br><br><br>

					<!-- PopUp Agregar Modelo-->
					<div data-role="main" class="ui-content">
    					<a href="#popupAgregarModelo" id="btnAgregarMod" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    					<div data-role="popup" id="popupAgregarModelo" class="ui-content">
      						<h3>Agregar Modelo</h3>
      						<input type="text" id="pop_inputAgregaModelo_FM" placeholder="Modelo...">
      						<center>
								<a id="agregarMod" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelarAgregarModelo" href="" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
							</center>
    					</div>
  					</div>

  					<!-- PopUp Elimnar Modelo-->
  					<div data-role="main" class="ui-content">
    					<a href="#popupEliminarModelo" id="btnAgregarMod" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    					<div data-role="popup" id="popupEliminarModelo" class="ui-content">
      						<h3>Eliminar Modelo</h3>
      						<p>Estas seguro de eliminar este <b>Modelo</b>???</p>
      						<center>
								<a id="eliminarModelo" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
								<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
							</center>
    					</div>
  					</div>
				</div>
			</div><br><br>
			<div id="divBtnsOp_FM">
				<center>
					<!-- PopUp Agregar Operacion -->
  					<div data-role="main" class="ui-content" id="btnAgregarOpe_FM">
    					<a href="#popupAgregarOperacion" id="btnAgregarOpe" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar Operacion</a>
    					<div data-role="popup" id="popupAgregarOperacion" class="ui-content">
      						<label for="operacion">Operacion</label>
      						<input type="text" id="operacionAgrega">
      						<label for="descripcion">Descripcion</label>
      						<input type="text" id="descripcionAgrega">

      						<fieldset data-iconpos="right">
      							<input name="checkbox" id="checkbox-h-6a" type="checkbox">
        						<label for="checkbox-h-6a">Usar en PPms?</label>
      						</fieldset>

      						<label for="grupo">Grupo</label>
      						<select name="grupoAgrega" id="grupoAgrega">
								<option value="default">- - - - - - -</option>
								<option value="final_test">Final Test</option>
								<option value="qc_audit">QC Audit</option>
								<option value="process">Process</option>
							</select>
							<a id="confirmarAgregado" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
							<a id="cancelarAgregado" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    					</div>
  					</div>

					<!-- PopUp Guardar Operacion -->
  					<div data-role="main" class="ui-content">
    					<a href="#popupGuardarOperacion" id="btnGuardarOpe_FM" data-rel="popup" class="ui-btn ui-icon-check ui-btn-icon-left ui-btn-inline ui-corner">Guardar Operacion</a>
    					<div data-role="popup" id="popupGuardarOperacion" class="ui-content">
      						<h3>Guardar Operacion</h3><hr>
      						<p>Confirmacion para guardar la <b>Operacion</b></p>
      						<center>
								<a id="eliminarOperacion" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
								<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
							</center>
    					</div>
  					</div>
					
					<!-- PopUp Eliminar Operacion -->
  					<div data-role="main" class="ui-content" id="divElimarOp_FM">
    					<a href="#popupEliminarOperacion" id="btnEliminarOpe" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar Operacion</a>
    					<div data-role="popup" id="popupEliminarOperacion" class="ui-content">
      						<h3>Eliminar Operacion</h3><hr>
      						<p>Estas seguro de eliminar esta <b>Operacion</b>???</p>
      						<center>
								<a id="eliminarOperacion" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
								<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
							</center>
    					</div>
  					</div>

					<!-- PopUp Copiar Operacion-->
					<div data-role="main" class="ui-content" id="divCopiarOp_FM">
    					<a href="#popupCopiarOperacion" id="btnCopiaOp" data-rel="popup" class="ui-btn ui-icon-edit ui-btn-icon-left ui-btn-inline ui-corner">Copiar Operacion</a>
    					<div data-role="popup" id="popupCopiarOperacion" class="ui-content">
      						<h3>Copiar Operaciones</h3><hr>
							<div data-role="fieldcontain" id="">
								<center><label for="mod_origen"><b>Modelo Origen</b></label></center>
								<select name="mod_origen" id="mod_origen">
									<option value="">0016 496900</option>
									<option value="">0059 419100</option>
									<option value="">50C70 495</option>
								</select>
							</div>
							<div data-role="fieldcontain" id="">
								<center><label for="mod_destino"><b>Modelo Destino</b></label></center>
								<select name="mod_destino" id="mod_destino">
									<option value="">50M61 843</option>
									<option value="">F59-478100</option>
									<option value="">50A51 235B1</option>
								</select>
							</div>
      						<center>
								<a id="copiarOperacion" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
								<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
							</center>
    					</div>
  					</div>
				</center>
			</div>
			<center>
				<div id="divTabla_FM">
						<table id="tabla_FM" cellpadding="0" cellspacing="0" border="0" class="hover">
						<thead>
							<tr>
								<th width="100" align="left">Operacion</th>
								<th width="330" align="left">Descripcion</th>
								<th width="130" align="left">PPms</th>
								<th width="120" align="left">Grupo</th>
							</tr>
						</thead>
						<tbody>
							<!--Primer Dato (Para el 2do hay que cambiar el id y el for)-->
							<tr>
								<td><span id="spanOperacion">Acalidad</span></td>
								<td><span id="spanDescripcion">Auditoria de Calidad</span></td>
								<td>
									<fieldset data-iconpos="left">
      									<input name="ppms" id="ppms" type="checkbox" >
        								<label for="ppms">Usar?</label>
      								</fieldset>
								</td>
								<td>
									<select name="grupoAgrega" id="grupoAgrega">
										<option value="default">- - - - - - -</option>
										<option value="final_test">Final Test</option>
										<option value="qc_audit">QC Audit</option>
										<option value="process">Process</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><span id="spanOperacion">Acalidad</span></td>
								<td><span id="spanDescripcion">Auditoria de Calidad</span></td>
								<td>
									<fieldset data-iconpos="left">
      									<input name="ppms" id="ppms1" type="checkbox" >
        								<label for="ppms1">Usar?</label>
      								</fieldset>
								</td>
								<td>
									<select name="grupoAgrega" id="grupoAgrega">
										<option value="default">- - - - - - -</option>
										<option value="final_test">Final Test</option>
										<option value="qc_audit">QC Audit</option>
										<option value="process">Process</option>
									</select>
								</td>
							</tr>
						</tbody>
				</div>
			</center>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="../../../js/js_tables.js"></script>

</body>
</html>