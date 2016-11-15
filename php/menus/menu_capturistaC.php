<?php
	require_once("../../php/conexion.php");
	if (isset($_SESSION['areasPerm'])) {
		$area = $_GET['area'];
		$areasPerm = $_SESSION['areasPerm'];
		$accesAreas = strpos($areasPerm, $area);
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
			<a href="../../php/interfaces/fam&mod.php?area=<?php echo "$area"; ?>" id="fam_mod"  data-role="button" class="ui-btn ui-icon-bars ui-btn-icon-left" data-transition="slide" data-ajax="false">Familias / Modelos</a>
			<a href="../../php/interfaces/operaciones.php?area=<?php echo "$area"; ?>" id="operaciones" data-role="button" class="ui-btn ui-icon-grid ui-btn-icon-left" data-transition="slide" data-ajax="false">Operaciones</a>
			<a href="../../php/interfaces/componentes.php?area=<?php echo "$area"; ?>" id="componentes" data-role="button" class="ui-btn ui-icon-gear ui-btn-icon-left" data-transition="slide" data-ajax="false">Componentes</a>
			<a href="../../php/interfaces/codigos_de_falla.php?area=<?php echo "$area"; ?>" id="codigos_de_falla" data-role="button" class="ui-btn ui-icon-tag ui-btn-icon-left" data-transition="slide" data-ajax="false">Codigos de Falla</a>
			<a href="../../php/interfaces/registros.php?area=<?php echo "$area"; ?>" id="registros" data-role="button" class="ui-btn ui-icon-bullets ui-btn-icon-left" data-transition="slide" data-ajax="false">Registros</a>
		</div>
		
		<div id="reportes" data-role="collapsible" data-collapsed-icon="bars" data-expanded-icon="carat-u">
			<h3><center>Reportes</center></h3>
			<a href="../../php/interfaces/correccion_datos.php?area=<?php echo "$area"; ?>" id="correccion_datos" data-role="button" title="Correccion de Datos" class="ui-btn ui-icon-edit ui-btn-icon-left" data-transition="slidedown" data-ajax="false">Correccion de Datos</a>
		</div><br><hr><br>

		<div id="area" data-role="collapsible" data-collapsed-icon="recycle" data-expanded-icon="carat-u">
			<h3><center>Seleccionar Area</center></h3>
			<fieldset data-role="controlgroup">
				<?php
					$accesElectronica = strpos($areasPerm, "Electronica");
					if ($accesElectronica === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/capturistaC/index.php?area=Electronica&areasPerm=<?php echo "$areasPerm"; ?>" id="btnElectronica" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electronica</a>
					<?php
					}
				?>

				<?php
					$accesElectromecanicos = strpos($areasPerm, "Electromecanicos");
					if ($accesElectromecanicos === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/capturistaC/index.php?area=Electromecanicos&areasPerm=<?php echo "$areasPerm"; ?>" id="btnElectromecanicos" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electromecanica</a>
					<?php
					}
				?>

				<?php
					$accesValvulas = strpos($areasPerm, "Valvulas");
					if ($accesValvulas === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/capturistaC/index.php?area=Valvulas&areasPerm=<?php echo "$areasPerm"; ?>" id="btnValvulas" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Valvulas</a>
					<?php
					}
				?>
			</fieldset>
		</div><br><hr><br>
		<!--<a href="index.php" data-role="button" id="inicio" class="ui-btn ui-icon-home ui-btn-icon-left" data-ajax="false">Inicio</a>-->
		<a href="../../php/logout.php" id="" class="ui-btn ui-icon-power ui-btn-icon-left" data-ajax="false">Salir</a>
	</div>
</div>