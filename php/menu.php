<!-- Menu -->
<div id="menu" data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal">
	<ul id="ul_menu" class="nav-search" data-role="listview" data-theme="b" data-divider-theme="a">
		<li data-icon="false" ><a href="#" id="menu_principal">Menu Principal</a></li>
		<br>
	</ul>
	<div id="divMenuPrincipal">
		<div id="captura" data-role="collapsible" data-collapsed-icon="edit" data-expanded-icon="carat-u">
			<h3><center>Captura</center></h3>
			<a href="fam&mod.php" id="fam_mod"  data-role="button" class="ui-btn ui-icon-bars ui-btn-icon-left" data-transition="slide">Familias / Modelos</a>
			<a href="operaciones.php" id="operaciones" data-role="button" class="ui-btn ui-icon-grid ui-btn-icon-left" data-transition="slide">Operaciones</a>
			<a href="componentes.php" id="componentes" data-role="button" class="ui-btn ui-icon-gear ui-btn-icon-left" data-transition="slide">Componentes</a>
			<a href="codigos_de_falla.php" id="codigos_de_falla" data-role="button" class="ui-btn ui-icon-tag ui-btn-icon-left" data-transition="slide">Codigos de Falla</a>
			<a href="registros.php" id="registros" data-role="button" class="ui-btn ui-icon-bullets ui-btn-icon-left" data-transition="slide">Registros</a>
		</div> 
		<div id="reportes" data-role="collapsible" data-collapsed-icon="bars" data-expanded-icon="carat-u">
			<h3><center>Reportes</center></h3>
			<a href="desempeno.php" id="desempeno"  data-role="button" title="Desempeño del Producto" class="ui-btn ui-icon-star ui-btn-icon-left" data-transition="slidedown">Desempeño del Producto</a>
			<a href="tendencia.php" id="tendencia" data-role="button" title="Graficas de Tendencia" class="ui-btn ui-icon-clock ui-btn-icon-left" data-transition="slidedown">Graficas de Tendencia</a>
			<a href="contribuyentes.php" id="contribuyentes" data-role="button" class="ui-btn ui-icon-bullets ui-btn-icon-left" data-transition="slidedown">Contribuyentes</a>
			<a href="correccion_datos.php" id="correccion_datos" data-role="button" title="Correccion de Datos" class="ui-btn ui-icon-edit ui-btn-icon-left" data-transition="slidedown">Correccion de Datos</a>
		</div>
		<div id="usuarios" data-role="collapsible" data-collapsed-icon="user" data-expanded-icon="carat-u">
		<h3><center>Usuarios</center></h3>
		<a href="permisos.php" id="permisos" data-role="button"  class="ui-btn ui-icon-eye ui-btn-icon-left" data-transition="slideup">Permisos</a>
		</div>

		<div id="area" data-role="collapsible" data-collapsed-icon="recycle" data-expanded-icon="carat-u">
			<h3><center>Cambiar Area</center></h3>
			<a href="electronica.php" data-role="button" id="electronica" class="ui-btn ui-icon-gear ui-btn-icon-left">Electronica</a>
			<a href="electromecanicos.php" data-role="button" id="electromecanicos" class="ui-btn ui-icon-gear ui-btn-icon-left">Electromecanicos</a>
			<a href="valvulas.php" data-role="button" id="valvulas" class="ui-btn ui-icon-gear ui-btn-icon-left">Valvulas</a>
		</div><br><hr><br>
		<a href="../login.html" id="" class="ui-btn ui-icon-power ui-btn-icon-left" onclick="window.close();">Salir</a>
	</div>
</div>