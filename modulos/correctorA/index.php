<?php
	session_start();
	require_once("../../php/conexion.php");
	$area = $_GET['area'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>SIC Ultimate Admin vw1.0</title>
	
	<?php include("../../php/librerias.php"); ?>
</head>
<style type="text/css">
	@media screen and (min-width: 480px) {
	    #container {
	        width: 100%;
	        height: 700px;
	        margin: 0 auto;
	    }
	}
	@media screen and (max-width: 1800px) {
	    #container {
	        width: 100%;
	        height: 550px;
	        margin: 0 auto;
	    }
	}
</style>
<body>
	<div data-role="page" data-theme="b" id="page">
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<h1>Corrector A</h1>
		</div>
		<?php 
			if (isset($_GET['area'])) {
				$area = $_GET['area'];
				if ($area == "Electronica") { ?>
					<script type="text/javascript">
					//column, bar, area, pie, areaspline, spline
						$(function () {
						    Highcharts.chart('container', {
						        title: {
						            text: 'produccion',
						            x: -20 //center
						        },
						        subtitle: {
						            text: 'electronica 2016',
						            x: -20
						        },
						        xAxis: {
						            categories: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO']
						        },
						        yAxis: {
						            title: {
						                text: 'produccion'
						            },
						            plotLines: [{
						                value: 0,
						                width: 1,
						                color: '#808080'
						            }]
						        },
						        tooltip: {
						            valueSuffix: 'pz'
						        },
						        legend: {
						            layout: 'vertical',
						            align: 'right',
						            verticalAlign: 'middle',
						            borderWidth: 0
						        },
						        //MES de Enero 50V51-290
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50V51-290' AND Fecha BETWEEN '2016-01-01' AND '2016-01-31'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaEne = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaEne = $sumaEne + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Febrero 50V51-290
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50V51-290' AND Fecha BETWEEN '2016-02-01' AND '2016-02-29'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaFeb = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaFeb = $sumaFeb + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Marzo 50V51-290
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50V51-290' AND Fecha BETWEEN '2016-03-01' AND '2016-03-31'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaMar = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaMar = $sumaMar + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Abril 50V51-290
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50V51-290' AND Fecha BETWEEN '2016-04-01' AND '2016-04-30'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaAbr = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaAbr = $sumaAbr + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Mayo 50V51-290
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50V51-290' AND Fecha BETWEEN '2016-05-01' AND '2016-05-31'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaMay = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaMay = $sumaMay + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        series: [{
						            name: '50V51-290',
						            data: [<?php echo "$sumaEne";?>, <?php echo "$sumaFeb";?>, <?php echo "$sumaMar";?>, <?php echo "$sumaAbr";?>, <?php echo "$sumaMay";?>]
						        },
						        //MES de Enero 50M58-242-01B1
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50M58-242-01B1' AND Fecha BETWEEN '2016-01-01' AND '2016-01-31'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaEne = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaEne = $sumaEne + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Febrero 50M58-242-01B1
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50M58-242-01B1' AND Fecha BETWEEN '2016-02-01' AND '2016-02-29'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaFeb = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaFeb = $sumaFeb + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Marzo 50M58-242-01B1
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50M58-242-01B1' AND Fecha BETWEEN '2016-03-01' AND '2016-03-31'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaMar = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaMar = $sumaMar + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Abril 50M58-242-01B1
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50M58-242-01B1' AND Fecha BETWEEN '2016-04-01' AND '2016-04-30'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaMar = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaMar = $sumaMar + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        //MES de Mayo 50M58-242-01B1
						        <?php
						        	$query = mysqli_query($con1, "SELECT Prod FROM datos WHERE Modelo = '50M58-242-01B1' AND Fecha BETWEEN '2016-05-01' AND '2016-05-31'");
						        	$rows_modelos = mysqli_num_rows($query);
						        	if ($rows_modelos != 0) {
						        		$sumaMay = 0;
										while ($row = mysqli_fetch_assoc($query)) {
											$sumaMay = $sumaMay + $row['Prod'];
										}
									} else {
										echo "<script>alert('Algo anda mal :(');</script>";
									}
						        ?>
						        	{name: '50M58-242-01B1',
						            data: [<?php echo "$sumaEne";?>, <?php echo "$sumaFeb";?>, <?php echo "$sumaMar";?>, <?php echo "$sumaAbr";?>, <?php echo "$sumaMay";?>]
						        }]
						    });
						});
					</script>
					<?php 
					} elseif ($area == "Electromecanicos") { ?>
						<script type="text/javascript">
							$(function () {
							    Highcharts.chart('container', {
							    	chart: {
										type: 'bar',
										options3d: {
											enabled: false,
											alpha: 15,
											beta: 15,
											depth: 50
										}
									},
									plotOptions: {
										column: {
											depth: 25,
											dataLabels: {
												enabled: true
											}
										}
									},
							        title: {
							            text: 'produccion',
							            x: -20 //center
							        },
							        subtitle: {
							            text: 'electromecanicos 2016',
							            x: -20
							        },
							        xAxis: {
							            categories: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO']
							        },
							        yAxis: {
							            title: {
							                text: 'produccion'
							            },
							            plotLines: [{
							                value: 0,
							                width: 1,
							                color: '#808080'
							            }]
							        },
							        tooltip: {
							            valueSuffix: 'pz'
							        },
							        legend: {
							            layout: 'vertical',
							            align: 'right',
							            verticalAlign: 'middle',
							            borderWidth: 0
							        },
							        //MES de Enero 08A05A101S1
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '08A05A101S1' AND Fecha BETWEEN '2016-01-01' AND '2016-01-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Ene = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Ene = $suma_Ene + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Febrero 08A05A101S1
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '08A05A101S1' AND Fecha BETWEEN '2016-02-01' AND '2016-02-29'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Feb = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Feb = $suma_Feb + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Marzo 08A05A101S1
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '08A05A101S1' AND Fecha BETWEEN '2016-03-01' AND '2016-03-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Mar = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Mar = $suma_Mar + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Abril 08A05A101S1
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '08A05A101S1' AND Fecha BETWEEN '2016-04-01' AND '2016-04-30'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Abr = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Abr = $suma_Abr + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Mayo 08A05A101S1
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '08A05A101S1' AND Fecha BETWEEN '2016-05-01' AND '2016-05-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_May = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_May = $suma_May + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>

							        series: [{
							            name: '08A05A101S1',
							            data: [<?php echo "$suma_Ene";?>, <?php echo "$suma_Feb";?>, <?php echo "$suma_Mar";?>, <?php echo "$suma_Abr";?>, <?php echo "$suma_May";?>]
							        },
							        //MES de Enero 0024 260600
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '0024 260600' AND Fecha BETWEEN '2016-01-01' AND '2016-01-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Ene = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Ene = $suma_Ene + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Febrero 0024 260600
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '0024 260600' AND Fecha BETWEEN '2016-02-01' AND '2016-02-29'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Feb = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Feb = $suma_Feb + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Marzo 0024 260600
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '0024 260600' AND Fecha BETWEEN '2016-03-01' AND '2016-03-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Mar = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Mar = $suma_Mar + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Abril 0024 260600
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '0024 260600' AND Fecha BETWEEN '2016-04-01' AND '2016-04-30'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Abr = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Abr = $suma_Abr + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Mayo 0024 260600
							        <?php
							        	$query = mysqli_query($con2, "SELECT Prod FROM datos WHERE Modelo = '0024 260600' AND Fecha BETWEEN '2016-05-01' AND '2016-05-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_May = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_May = $suma_May + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        	{name: '0024 260600',
							            data: [<?php echo "$suma_Ene";?>, <?php echo "$suma_Feb";?>, <?php echo "$suma_Mar";?>, <?php echo "$suma_Abr";?>, <?php echo "$suma_May";?>]
							        }]
							    });
							});
						</script>
					<?php	
					} elseif ($area == "Valvulas") { ?>
						<script type="text/javascript">
							$(function () {
							    Highcharts.chart('container', {
							    	chart: {
										type: 'column',
										options3d: {
											enabled: false,
											alpha: 15,
											beta: 15,
											depth: 50
										}
									},
									plotOptions: {
										column: {
											depth: 25,
											dataLabels: {
												enabled: true
											}
										}

									},
							        title: {
							            text: 'produccion',
							            x: -20 //center
							        },
							        subtitle: {
							            text: 'valvulas 2016',
							            x: -20
							        },
							        xAxis: {
							            categories: ['ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO']
							        },
							        yAxis: {
							            title: {
							                text: 'produccion'
							            },
							            plotLines: [{
							                value: 0,
							                width: 1,
							                color: '#808080'
							            }]
							        },
							        tooltip: {
							            valueSuffix: 'pz'
							        },
							        legend: {
							            layout: 'vertical',
							            align: 'right',
							            verticalAlign: 'middle',
							            borderWidth: 0
							        },
							        //MES de Enero 25M05A-129P1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '25M05A-129P1' AND Fecha BETWEEN '2016-01-01' AND '2016-01-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Ene = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Ene = $suma_Ene + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Febrero 25M05A-129P1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '25M05A-129P1' AND Fecha BETWEEN '2016-02-01' AND '2016-02-29'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Feb = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Feb = $suma_Feb + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Marzo 25M05A-129P1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '25M05A-129P1' AND Fecha BETWEEN '2016-03-01' AND '2016-03-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Mar = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Mar = $suma_Mar + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Abril 25M05A-129P1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '25M05A-129P1' AND Fecha BETWEEN '2016-04-01' AND '2016-04-30'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Abr = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Abr = $suma_Abr + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Mayo 25M05A-129P1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '25M05A-129P1' AND Fecha BETWEEN '2016-05-01' AND '2016-05-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_May = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_May = $suma_May + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>

							        series: [{
							            name: '25M05A-129P1',
							            data: [<?php echo "$suma_Ene";?>, <?php echo "$suma_Feb";?>, <?php echo "$suma_Mar";?>, <?php echo "$suma_Abr";?>, <?php echo "$suma_May";?>]
							        },
							        //MES de Enero 1-25M01A157B1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '1-25M01A157B1' AND Fecha BETWEEN '2016-01-01' AND '2016-01-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Ene = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Ene = $suma_Ene + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Febrero 1-25M01A157B1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '1-25M01A157B1' AND Fecha BETWEEN '2016-02-01' AND '2016-02-29'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Feb = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Feb = $suma_Feb + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Marzo 1-25M01A157B1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '1-25M01A157B1' AND Fecha BETWEEN '2016-03-01' AND '2016-03-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Mar = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Mar = $suma_Mar + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Abril 1-25M01A157B1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '1-25M01A157B1' AND Fecha BETWEEN '2016-04-01' AND '2016-04-30'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_Abr = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_Abr = $suma_Abr + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        //MES de Mayo 1-25M01A157B1
							        <?php
							        	$query = mysqli_query($con3, "SELECT Prod FROM datos WHERE Modelo = '1-25M01A157B1' AND Fecha BETWEEN '2016-05-01' AND '2016-05-31'");
							        	$rows_modelos = mysqli_num_rows($query);
							        	if ($rows_modelos != 0) {
							        		$suma_May = 0;
											while ($row = mysqli_fetch_assoc($query)) {
												$suma_May = $suma_May + $row['Prod'];
											}
										} else {
											echo "<script>alert('Algo anda mal :(');</script>";
										}
							        ?>
							        	{name: '1-25M01A157B1',
							            data: [<?php echo "$suma_Ene";?>, <?php echo "$suma_Feb";?>, <?php echo "$suma_Mar";?>, <?php echo "$suma_Abr";?>, <?php echo "$suma_May";?>]
							        }]
							    });
							});
						</script>
					<?php
				}
			}

			include("../../php/menus/menu_correctorA.php");
		?>
		<div id="container"></div>
	</div>
</body>
</html>