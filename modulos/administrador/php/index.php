
<?php
	session_start();
	require_once("../../../php/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	
	<title>SIC Ultimate Admin vw1.0</title>
	
	<script src="../../../js/jquery-1.12.4.min.js"></script>
	<script src="../../../js/jquery.mobile-1.4.5.js"></script>
	<script src="../../../js/highcharts/highcharts.js"></script>
	<!--<script src="../../../js/highcharts/highcharts-3d.js"></script>-->
	<script src="../../../js/highcharts/dark-unica.js"></script>
	<script src="../../../js/highcharts/exporting.js"></script>
	<script src="../../../js/highcharts/js_graficsAdmin.js"></script>
	
	<link rel="stylesheet" href="../../../css/jquery.mobile-1.4.5.css">
	<link rel="stylesheet" href="../../../css/css_style.css">

	
</head>
<body>
	<div data-role="page" data-theme="b" id="page">
		<div data-role="header" id="header">
			<a href="#menu" data-icon="bars" data-iconpos="notext"></a>
			<center>
				<img src="../../../public/images/Sicicon.ico">
			</center>
			<h1>Administrador</h1>
		</div>
		<?php 
			include("menu.php");
			
			if (isset($_GET['area'])) {
				$area = $_GET['area'];
				if ($area == "electronica") { ?>
				<script type="text/javascript">
					$(function () {
					    Highcharts.chart('container', {
					        title: {
					            text: 'produccion L2',
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
				} elseif ($area == "electromecanicos") { 
					
				} elseif ($area == "valvulas") {
					$query = mysqli_query($con3, "SELECT * FROM modelos WHERE Modelo = '07 68A415B3'");
					$rows_modelos = mysqli_num_rows($query);
					if ($rows_modelos != 0) {
						while ($row = mysqli_fetch_assoc($query)) {
							echo "<div>".$row['ID']."<br>".$row['Modelo']."<br>".$row['Familia']."</div>";
						}
					} else {
						echo "<script>alert('Algo anda mal :(');</script>";
					}
				}
			}
		?>
		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</div>
</body>
</html>

