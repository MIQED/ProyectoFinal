<?php 
	include '../../bd_con/conexion.php';
	session_start();

	$alu = $_POST["alumno"];

	$sql = "SELECT * FROM alumno INNER JOIN convenio ON convenio.con_alumnoid = alumno.alu_id WHERE (alu_nombre LIKE '%$alu%' OR alu_apellido1 LIKE '%$alu%' OR alu_apellido2 LIKE '%$alu%' OR alu_dni LIKE '%$alu%') AND con_empresaid = $_SESSION[id] ORDER BY alu_apellido1";

	$alumnos = mysqli_query($conexion, $sql);

	if (mysqli_num_rows($alumnos)>0){
		echo "<table>";
			echo "<tr>";	
				echo "<th>DNI</th>";
				echo "<th>Nombre</th>";
				echo "<th>Apellidos</th>";
			echo "</tr>";
			while($alumno = mysqli_fetch_object($alumnos)){
				echo "<tr>";
					echo "<td>$alumno->alu_dni</td>";
					echo "<td>$alumno->alu_nombre</td>";
					echo "<td>$alumno->alu_apellido1 $alumno->alu_apellido2</td>";
				echo "</tr>";
			}
		echo "</table>";
	} else {
		echo "<h2>Ningún alumno coincide con la búsqueda</h2>";
	}

 ?>