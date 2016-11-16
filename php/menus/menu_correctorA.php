<?php
	session_start();
	require_once("../../php/conexion.php");
	if (isset($_SESSION['areasPerm'])) {
		if (isset($_SESSION['tipoUser'])) {
			$tipoUser = $_SESSION['tipoUser'];
			$area = $_GET['area'];
			$areasPerm = $_SESSION['areasPerm'];
			$accesAreas = strpos($areasPerm, $area);
		}
	}
?>

<!-- Menu -->
<div id="menu" data-role="panel" data-position="left" data-position-fixed="false" data-display="reveal">
	<ul id="ul_menu" class="nav-search" data-role="listview" data-theme="b" data-divider-theme="a">
		<li data-icon="false" ><a href="#" id="menu_principal">Menu Principal</a></li>
		<br>
	</ul>
	<div id="divMenuPrincipal">

		<div id="reportes" data-role="collapsible" data-collapsed-icon="bars" data-expanded-icon="carat-u">
			<h3><center>Reportes</center></h3>
			<a href="../../php/interfaces/correccion_datos.php?area=<?php echo "$area"; ?>&tipoUser=<?php echo "$tipoUser"; ?>" id="correccion_datos" data-role="button" title="Correccion de Datos" class="ui-btn ui-icon-edit ui-btn-icon-left" data-transition="slidedown" data-ajax="false">Correccion de Datos</a>
		</div><br><hr><br>

		<div id="area" data-role="collapsible" data-collapsed-icon="recycle" data-expanded-icon="carat-u">
			<h3><center>Seleccionar Area</center></h3>
			<fieldset data-role="controlgroup">
				<?php
					$accesElectronica = strpos($areasPerm, "Electronica");
					if ($accesElectronica === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/correctorA/index.php?area=Electronica&areasPerm=<?php echo "$areasPerm"; ?>" id="btnElectronica" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electronica</a>
					<?php
					}
				?>

				<?php
					$accesElectromecanicos = strpos($areasPerm, "Electromecanicos");
					if ($accesElectromecanicos === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/correctorA/index.php?area=Electromecanicos&areasPerm=<?php echo "$areasPerm"; ?>" id="btnElectromecanicos" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electromecanica</a>
					<?php
					}
				?>

				<?php
					$accesValvulas = strpos($areasPerm, "Valvulas");
					if ($accesValvulas === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/correctorA/index.php?area=Valvulas&areasPerm=<?php echo "$areasPerm"; ?>" id="btnValvulas" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Valvulas</a>
					<?php
					}
				?>
			</fieldset>
		</div><br><hr><br>

		<a href="../../php/logout.php" id="" class="ui-btn ui-icon-power ui-btn-icon-left" data-ajax="false">Salir</a>
	</div>
</div>