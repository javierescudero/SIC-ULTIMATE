<?php
	require_once("../../php/conexion.php");
	if (isset($_GET['area'])) {
		$area = $_GET['area'];
	}
?>
<!-- Menu -->
<div id="menu" data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal">
	<ul id="ul_menu" class="nav-search" data-role="listview" data-theme="b" data-divider-theme="a">
		<li data-icon="false" ><a href="#" id="menu_principal">Menu Principal</a></li>
		<br>
	</ul>
	<div id="divMenuPrincipal">
		<div id="captura" data-role="collapsible" data-collapsed-icon="edit" data-expanded-icon="carat-u">
			<h3><center>Captura</center></h3>
			<a href="../../php/interfaces/fam&mod.php" id="fam_mod"  data-role="button" class="ui-btn ui-icon-bars ui-btn-icon-left" data-transition="slide" data-ajax="false">Familias / Modelos</a>
			<a href="../../php/interfaces/operaciones.php" id="operaciones" data-role="button" class="ui-btn ui-icon-grid ui-btn-icon-left" data-transition="slide" data-ajax="false">Operaciones</a>
			<a href="../../php/interfaces/componentes.php" id="componentes" data-role="button" class="ui-btn ui-icon-gear ui-btn-icon-left" data-transition="slide" data-ajax="false">Componentes</a>
			<a href="../../php/interfaces/codigos_de_falla.php" id="codigos_de_falla" data-role="button" class="ui-btn ui-icon-tag ui-btn-icon-left" data-transition="slide" data-ajax="false">Codigos de Falla</a>
			<a href="../../php/interfaces/registros.php" id="registros" data-role="button" class="ui-btn ui-icon-bullets ui-btn-icon-left" data-transition="slide" data-ajax="false">Registros</a>
		</div><br><hr><br>

		<div id="area" data-role="collapsible" data-collapsed-icon="recycle" data-expanded-icon="carat-u">
			<h3><center>Seleccionar Area</center></h3>
			<fieldset data-role="controlgroup">
				<input name="radio-choice-v-2" id="radio-choice-v-2a" value="on" checked="checked" type="radio">
		        <label for="radio-choice-v-2a">Electronica</label>
		        <input name="radio-choice-v-2" id="radio-choice-v-2b" value="off" type="radio">
		        <label for="radio-choice-v-2b">Electromecanicos</label>
		        <input name="radio-choice-v-2" id="radio-choice-v-2c" value="other" type="radio">
		        <label for="radio-choice-v-2c">Valvulas</label>
			</fieldset>
		</div><br><hr><br>
		<!--<a href="index.php" data-role="button" id="inicio" class="ui-btn ui-icon-home ui-btn-icon-left" data-ajax="false">Inicio</a>-->
		<a href="../../php/logout.php" id="" class="ui-btn ui-icon-power ui-btn-icon-left" data-ajax="false">Salir</a>
	</div>
</div>