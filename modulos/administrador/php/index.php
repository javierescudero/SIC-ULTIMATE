
<?php
	session_start();
	//require_once("conexionDB.php");
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

	<script type="text/javascript">
		$(function () {
		    Highcharts.chart('container', {
		        title: {
		            text: 'Monthly Average Temperature',
		            x: -20 //center
		        },
		        subtitle: {
		            text: 'Source: WorldClimate.com',
		            x: -20
		        },
		        xAxis: {
		            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
		                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		        },
		        yAxis: {
		            title: {
		                text: 'Temperature (°C)'
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: '°C'
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Tokyo',
		            data: [9.2, 4.1, 11.7, 16.7, 20.4, 23.7, 27.4, 28.7, 25.5, 20.5, 15.1, 11.8]
		        }, {
		            name: 'New York',
		            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
		        }, {
		            name: 'Berlin',
		            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
		        }, {
		            name: 'London',
		            data: [1.7, 2.0, 3.5, 6.3, 9.7, 13.0, 15.8, 14.4, 12.0, 8.1, 4.4, 2.6]
		        }]
		    });
		});
	</script>
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
			$area = $_GET['area'];
		?>

		<?php
			if ($area == "electronica") {
				$query = mysqli_query($con1, "SELECT * FROM modelos WHERE Modelo = '11E79 101B1'");
				$rows_modelos = mysqli_num_rows($query);
				if ($rows_modelos != 0) {
					while ($row = mysqli_fetch_assoc($query)) {
						echo "<div>".$row['ID']."<br>".$row['Modelo']."<br>".$row['Familia']."</div>";
					}
				} else {
					echo "<script>alert('Algo anda mal :(');</script>";
				}
			} elseif ($area == "electromecanicos") {
				$query = mysqli_query($con2, "SELECT * FROM modelos WHERE ID = '7'");
				$rows_modelos = mysqli_num_rows($query);
				if ($rows_modelos != 0) {
					while ($row = mysqli_fetch_assoc($query)) {
						echo "<div>".$row['ID']."<br>".$row['Modelo']."<br>".$row['Familia']."</div>";
					}
				} else {
					echo "<script>alert('Algo anda mal :(');</script>";
				}
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
			
		?>
		<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
	</div>
</body>
</html>

