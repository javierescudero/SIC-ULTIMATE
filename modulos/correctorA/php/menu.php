<!-- Menu -->
<div id="menu" data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal">
	<ul id="ul_menu" class="nav-search" data-role="listview" data-theme="b" data-divider-theme="a">
		<li data-icon="false" ><a href="#" id="menu_principal">Menu Principal</a></li>
		<br>
	</ul>
	<div id="divMenuPrincipal">

		<div id="reportes" data-role="collapsible" data-collapsed-icon="bars" data-expanded-icon="carat-u">
			<h3><center>Reportes</center></h3>
			<a href="correccion_datos.php" id="correccion_datos" data-role="button" title="Correccion de Datos" class="ui-btn ui-icon-edit ui-btn-icon-left" data-transition="slidedown" data-ajax="false">Correccion de Datos</a>
		</div><br><hr><br>

		<div id="area" data-role="collapsible" data-collapsed-icon="recycle" data-expanded-icon="carat-u">
			<h3><center>Seleccionar Area</center></h3>
			<a href="electronica.php" data-role="button" id="electronica" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electronica</a>
			<a href="electromecanicos.php" data-role="button" id="electromecanicos" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electromecanicos</a>
			<a href="valvulas.php" data-role="button" id="valvulas" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Valvulas</a>
		</div><br><hr><br>
		<!--<a href="index.php" data-role="button" id="inicio" class="ui-btn ui-icon-home ui-btn-icon-left" data-ajax="false">Inicio</a>-->
		<a href="../../../index.php" id="" class="ui-btn ui-icon-power ui-btn-icon-left" data-ajax="false">Salir</a>
	</div>
</div>