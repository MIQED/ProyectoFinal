<?php 

	include '../../bd_con/conexion.php';
	session_start();
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body>
 	 <div><a href="proc/logout.proc.php">Cerrar sessión</a></div>
	 <h1>Alumnos</h1>
	<?php 
		echo "<table border>";
			echo "<tr>";
				echo "<th>Apellidos</th>";
				echo "<th>Nombre</th>";
				echo "<th>Correo</th>";
				echo "<th>Telefono</th>";
				echo "<th>Validar</th>";
			echo "</tr>";
		$alumnos_sql = "SELECT * FROM convenio INNER JOIN alumno ON alumno.alu_id = convenio.con_alumnoid WHERE con_empresaid = $_SESSION[id] ORDER BY alu_apellido1";
		$alumnos = mysqli_query($conexion, $alumnos_sql);
		while ($alumno = mysqli_fetch_object($alumnos)) {
				echo "<tr>";
					echo "<td>$alumno->alu_apellido1 $alumno->alu_apellido2</td>";
					echo "<td>$alumno->alu_nombre</td>";
					echo "<td>$alumno->alu_email</td>";
					echo "<td>$alumno->alu_telf</td>";
					echo "<td>F*** U</td>";
				echo "</tr>";
		}
		echo "</table>";
	 ?>
 </body>
 </html>