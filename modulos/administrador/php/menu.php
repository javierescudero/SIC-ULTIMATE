<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>

<!-- Menu -->
<form method="post" action="index.php" id="form_menu" data-ajax="false">
	<div id="menu" data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal">
		<ul id="ul_menu" class="nav-search" data-role="listview" data-theme="b" data-divider-theme="a">
			<li data-icon="false" ><a href="#" id="menu_principal">Menu Principal</a></li>
			<br>
		</ul>
		<div id="divMenuPrincipal">
			<div id="captura" data-role="collapsible" data-collapsed-icon="edit" data-expanded-icon="carat-u">
				<h3><center>Captura</center></h3>
				<!--<?php //echo "<a href='fam&mod.php?area='".$_POST['area']."' id='fam_mod'  data-role='button' class='ui-btn ui-icon-bars ui-btn-icon-left' data-transition='slide' data-ajax='false'>PRUEBA</a>";?>-->
				<a href="fam&mod.php?area=" id="fam_mod"  data-role="button" class="ui-btn ui-icon-bars ui-btn-icon-left" data-transition="slide" data-ajax="false">Familias / Modelos</a>
				<a href="operaciones.php" id="operaciones" data-role="button" class="ui-btn ui-icon-grid ui-btn-icon-left" data-transition="slide" data-ajax="false">Operaciones</a>
				<a href="componentes.php" id="componentes" data-role="button" class="ui-btn ui-icon-gear ui-btn-icon-left" data-transition="slide" data-ajax="false">Componentes</a>
				<a href="codigos_de_falla.php" id="codigos_de_falla" data-role="button" class="ui-btn ui-icon-tag ui-btn-icon-left" data-transition="slide" data-ajax="false">Codigos de Falla</a>
				<a href="registros.php" id="registros" data-role="button" class="ui-btn ui-icon-bullets ui-btn-icon-left" data-transition="slide" data-ajax="false">Registros</a>
			</div> 
			<div id="reportes" data-role="collapsible" data-collapsed-icon="bars" data-expanded-icon="carat-u">
				<h3><center>Reportes</center></h3>
				<a href="desempeno.php" id="desempeno"  data-role="button" title="Desempeño del Producto" class="ui-btn ui-icon-star ui-btn-icon-left" data-transition="slidedown" data-ajax="false">Desempeño del Producto</a>
				<a href="tendencia.php" id="tendencia" data-role="button" title="Graficas de Tendencia" class="ui-btn ui-icon-clock ui-btn-icon-left" data-transition="slidedown" data-ajax="false">Graficas de Tendencia</a>
				<a href="contribuyentes.php" id="contribuyentes" data-role="button" class="ui-btn ui-icon-bullets ui-btn-icon-left" data-transition="slidedown" data-ajax="false">Contribuyentes</a>
				<a href="correccion_datos.php" id="correccion_datos" data-role="button" title="Correccion de Datos" class="ui-btn ui-icon-edit ui-btn-icon-left" data-transition="slidedown" data-ajax="false">Correccion de Datos</a>
			</div>
			<div id="usuarios" data-role="collapsible" data-collapsed-icon="user" data-expanded-icon="carat-u">
			<h3><center>Usuarios</center></h3>
			<a href="permisos.php" id="permisos" data-role="button"  class="ui-btn ui-icon-eye ui-btn-icon-left" data-transition="slideup" data-ajax="false">Permisos</a>
			</div><br><hr><br>

			<div id="area" data-role="collapsible" data-collapsed-icon="recycle" data-expanded-icon="carat-u">
				<h3><center>Seleccionar Area</center></h3>
				<fieldset data-role="controlgroup">
			        <a href="index.php?area=electronica" id="btnElectronica" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electronica</a>
			        <a href="index.php?area=electromecanicos" id="btnElectromecanicos" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electromecanica</a>
			        <a href="index.php?area=valvulas" id="btnValvulas" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Valvulas</a>
				</fieldset>
			</div><br><hr><br>
			<a href="../../../php/logout.php" id="" class="ui-btn ui-icon-power ui-btn-icon-left" data-ajax="false">Salir</a>
		</div>
	</div>
</form>
</body>
</html>