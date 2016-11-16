<?php
	session_start();
	require_once("../../php/conexion.php");
	if (isset($_SESSION['areasPerm'])) {
		if (isset($_SESSION['tipoUser'])) {
			$tipoUser = $_SESSION['tipoUser'];
			$area = $_GET['area'];
			$areasPerm = $_SESSION['areasPerm'];
			$accesAreas = strpos($areasPerm, $area);
			$user = $_SESSION['session_nombre_usuario'];
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
		<div id="captura" data-role="collapsible" data-collapsed-icon="edit" data-expanded-icon="carat-u">
			<h3><center>Captura</center></h3>
			<a href="../../php/interfaces/fam&mod.php?area=<?php echo "$area"; ?>&tipoUser=<?php echo "$tipoUser"; ?>" id="fam_mod"  data-role="button" class="ui-btn ui-icon-bars ui-btn-icon-left" data-transition="slide" data-ajax="false">Familias / Modelos</a>
			<a href="../../php/interfaces/operaciones.php?area=<?php echo "$area"; ?>&tipoUser=<?php echo "$tipoUser"; ?>" id="operaciones" data-role="button" class="ui-btn ui-icon-grid ui-btn-icon-left" data-transition="slide" data-ajax="false">Operaciones</a>
			<a href="../../php/interfaces/componentes.php?area=<?php echo "$area"; ?>&tipoUser=<?php echo "$tipoUser"; ?>" id="componentes" data-role="button" class="ui-btn ui-icon-gear ui-btn-icon-left" data-transition="slide" data-ajax="false">Componentes</a>
			<a href="../../php/interfaces/codigos_de_falla.php?area=<?php echo "$area"; ?>&tipoUser=<?php echo "$tipoUser"; ?>" id="codigos_de_falla" data-role="button" class="ui-btn ui-icon-tag ui-btn-icon-left" data-transition="slide" data-ajax="false">Codigos de Falla</a>
			<a href="../../php/interfaces/registros.php?area=<?php echo "$area"; ?>&tipoUser=<?php echo "$tipoUser"; ?>" id="registros" data-role="button" class="ui-btn ui-icon-bullets ui-btn-icon-left" data-transition="slide" data-ajax="false">Registros</a>
		</div><br><hr><br>

		<div id="area" data-role="collapsible" data-collapsed-icon="recycle" data-expanded-icon="carat-u">
			<h3><center>Seleccionar Area</center></h3>
			<fieldset data-role="controlgroup">
				<?php
					$accesElectronica = strpos($areasPerm, "Electronica");
					if ($accesElectronica === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/capturistaA/index.php?area=Electronica&areasPerm=<?php echo "$areasPerm"; ?>&user=<?php echo "$user"; ?>" id="btnElectronica" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electronica</a>
					<?php
					}
				?>

				<?php
					$accesElectromecanicos = strpos($areasPerm, "Electromecanicos");
					if ($accesElectromecanicos === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/capturistaA/index.php?area=Electromecanicos&areasPerm=<?php echo "$areasPerm"; ?>&user=<?php echo "$user"; ?>" id="btnElectromecanicos" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Electromecanica</a>
					<?php
					}
				?>

				<?php
					$accesValvulas = strpos($areasPerm, "Valvulas");
					if ($accesValvulas === false) {
					} else { ?>
						<a href="../../../sic-ultimate/modulos/capturistaA/index.php?area=Valvulas&areasPerm=<?php echo "$areasPerm"; ?>&user=<?php echo "$user"; ?>" id="btnValvulas" class="ui-btn ui-icon-gear ui-btn-icon-left" data-ajax="false">Valvulas</a>
					<?php
					}
				?>
			</fieldset>
		</div><br><hr><br>

		<a href="../../php/logout.php" id="" class="ui-btn ui-icon-power ui-btn-icon-left" data-ajax="false">Salir</a>
	</div>
</div>