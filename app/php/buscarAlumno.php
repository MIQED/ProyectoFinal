<?php 
	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';

	$alu = $_POST["alumno"];

	if ($alu != ""){

	$sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE (alu_nombre LIKE '%$alu%' OR alu_apellido1 LIKE '%$alu%' OR alu_apellido2 LIKE '%$alu%' OR alu_dni LIKE '%$alu%') AND cic_tutescid = $_SESSION[id] ORDER BY alu_apellido1";

	$alumnos = mysqli_query($conexion, $sql);

	if (mysqli_num_rows($alumnos)>0){
		echo "<table>";
			echo "<tr>";	
				echo "<th>DNI</th>";
				echo "<th>Nombre</th>";
				echo "<th>Apellidos</th>";
				echo "<th>Correo</th>";
				echo "<td></td>";
			echo "</tr>";
			while($alumno = mysqli_fetch_object($alumnos)){
				echo "<tr>";
					echo "<td>$alumno->alu_dni</td>";
					echo "<td>$alumno->alu_nombre</td>";
					echo "<td>$alumno->alu_apellido1 $alumno->alu_apellido2</td>";
					echo "<td>$alumno->alu_email</td>";
					echo "<td><a href='verAlumno.php?al=$alumno->alu_id'>Ver</a></td>";
				echo "</tr>";
			}
		echo "</table>";
	} else {
		echo "<h2>Ningún alumno coincide con la búsqueda</h2>";
	}
}

 ?>