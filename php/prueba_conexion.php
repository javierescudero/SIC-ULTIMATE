<?php
	if (!($conexion = mysql_connect("localhost", "root", "root"))) {
		echo "Sin conexion";
		exit();
	} else {
		mysql_select_db("Electronica", $conexion);

		$query = "SELECT * FROM operaciones";
		$result = mysql_query($query, $conexion);

		echo "<table>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>ID</th>";
		echo "<th>Modelo</th>";
		echo "<th>Descripcion</th>";
		echo "<th>Familia</th>";
		echo "<th>Operacion</th>";
		echo "<th>UsarPPms</th>";
		echo "<th>Grupo</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";

		while ($row =mysql_fetch_row($result)) {
			echo "<tr>";
			echo "<td>".$row[0]."</td>";
			echo "<td>".$row[1]."</td>";
			echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			echo "</tr>";
		}

		echo "</tbody>";
		echo "</table>";

		//Liberas el resultado
		mysql_free_result($result);


		//Cerras coneccion
		mysql_close($conexion); 
	}
?>