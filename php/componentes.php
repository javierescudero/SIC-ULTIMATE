<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<title>SIC Ultimate</title>

	<script src="../js/jquery-1.12.4.min.js"></script>
	<script src="../js/jquery.mobile-1.4.5.js"></script>
	<script src="../js/js_refresh.js"></script>
	
	<link rel="stylesheet" href="../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../css/css_style.css">
</head>
<body>
	<div data-role="page" data-theme="b" id="divPage">
		<?php 
			include("menu.php");
		?>
		<div id="divFormComp">
			<form action="">
				<center>
					<div data-role="fieldcontain" id="divContentModelo_Comp">
						<center>
							<label for="modelo"><b>Modelo</b></label>
						</center>
						<select name="modelo" id="modelo">
							<option value="">50M61 843</option>
							<option value="">F59-478100</option>
							<option value="">50M61 843</option>
							<option value="">0059 474000</option>
							<option value="">0059 478300</option>
							<option value="">1F83C-11NPB1</option>
							<option value="">50M61 843</option>
							<option value="">F59-478100</option>
							<option value="">50M61 843</option>
							<option value="">0059 474000</option>
						</select>
					</div>
				</center>

				<!--Listview de los componentes-->
				<center>
					<center><label for="componente" data-theme="c"><b>Componente</b></label></center>
					<div id="divLvwComponentes_Comp">
						<ul data-role="listview">
							<li data-icon="false"><a href="">C1</a></li>
							<li data-icon="false"><a href="">C2</a></li>
							<li data-icon="false"><a href="">C3</a></li>
							<li data-icon="false"><a href="">C11</a></li>
							<li data-icon="false"><a href="">C11</a></li>
							<li data-icon="false"><a href="">C1</a></li>
							<li data-icon="false"><a href="">C2</a></li>
							<li data-icon="false"><a href="">C3</a></li>
							<li data-icon="false"><a href="">C11</a></li>
							<li data-icon="false"><a href="">C11</a></li>
							<li data-icon="false"><a href="">C1</a></li>
							<li data-icon="false"><a href="">C2</a></li>
							<li data-icon="false"><a href="">C3</a></li>
							<li data-icon="false"><a href="">C11</a></li>
							<li data-icon="false"><a href="">C11</a></li>
						</ul>
					</div>
				</center>
				
				<!-- Botones -->
				<center>
					<div id="divBtnsComponentes_Comp">
						<!-- PopUp Agregar Componente -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupAgregar" id="btnAgregar" data-rel="popup" class="ui-btn ui-icon-plus ui-btn-icon-left ui-btn-inline ui-corner">Agregar</a>
    						<div data-role="popup" id="popupAgregar" class="ui-content">
      							<h3>Agregar Componente</h3><hr>
      							<input type="text" id="agregarComponente">
								<a id="agregarComponenteConfirmacion" href="#" data-role="button" data-icon="check" data-inline="true">Agregar</a>
								<a id="cancelar" href="#" data-role="button" data-icon="delete" data-rel="back" data-inline="true">Cancelar</a>
    						</div>
  						</div>

  						<!-- PopUp Eliminar Componente -->
  						<div data-role="main" class="ui-content">
    						<a href="#popupEliminar" id="btnEliminar" data-rel="popup" class="ui-btn ui-icon-minus ui-btn-icon-left ui-btn-inline ui-corner">Eliminar</a>
    						<div data-role="popup" id="popupEliminar" class="ui-content">
      							<h3>Eliminar Componente</h3><hr>
      							<p>Estas seguro de eliminar este <b>Componente</b>???</p>
      							<center>
									<a id="eliminar" href="#" data-role="button" data-icon="check" data-inline="true">Si</a>
									<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">No</a>
								</center>
    						</div>
  						</div>

  						<!-- PopUp Copiar Componente-->
						<div data-role="main" class="ui-content">
    						<a href="#popupCopiar" id="btnCopia" data-rel="popup" class="ui-btn ui-icon-bars ui-btn-icon-left ui-btn-inline ui-corner">Copiar de . . .</a>
    						<div data-role="popup" id="popupCopiar" class="ui-content">
      							<h3>Copiar Componentes</h3><hr>
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
									<a id="copiar" href="#" data-role="button" data-icon="edit" data-inline="true">Copiar</a>
									<a id="salir" href="#" data-role="button" data-rel="back" data-icon="back" data-inline="true">Cancelar</a>
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