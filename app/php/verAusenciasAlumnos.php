<?php
	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';

	$dato = $_POST['dato'];
	if ($dato != ""){
		$sql = "UPDATE ausencia SET aus_visto ='1' WHERE aus_id = '$dato'"; 
		mysqli_query($conexion, $sql);
	}

	$ausecia_sql = "SELECT * FROM ausencia INNER JOIN convenio ON convenio.con_id = ausencia.aus_convenioid INNER JOIN alumno ON alumno.alu_id = convenio.con_alumnoid WHERE con_empresaid=$_SESSION[id] AND aus_visto='0'";
	$ausencias = mysqli_query($conexion, $ausecia_sql);
	if (mysqli_num_rows($ausencias)>0){
		while ($ausencia = mysqli_fetch_object($ausencias)) {
		echo "<table class='table' style='background:white'>";
			echo "<tr>";
				echo "<th>Apellidos</th>";
				echo "<th>Nombre</th>";
				echo "<th>Correo</th>";
				echo "<th>Telf</th>";
				echo "<th><a href='#' onclick='enviarDatos($ausencia->aus_id);'><i class='fa fa-times fa-lg' aria-hidden='true'></i></a></th>";
			echo "</tr>";
			echo "<tr>";
		 		echo "<td>$ausencia->alu_apellido1 $ausencia->alu_apellido2</td>";
		 		echo "<td>$ausencia->alu_nombre</td>";
		 		echo "<td>$ausencia->alu_email</td>";
		 		echo "<td>$ausencia->alu_telf</td>";
		 		echo "<td></td>";
		 	echo "</tr>";
			echo "<tr>";
				echo "<th colspan='4'>Motivo</th>";
				echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
		 		echo "<td colspan='4'>$ausencia->aus_motivo</td>";
		 		echo "<td></td>";
		 	echo "</tr>";
			echo "<tr>";
				echo "<th>Horas</th>";
				echo "<th colspan='2'>Fecha</th>";
				echo "<th>Fichero</th>";
				echo "<td></td>";
			echo "</tr>";
		 	echo "<tr>";
		 		echo "<td>$ausencia->aus_horas</td>";
		 		echo "<td colspan='2'>$ausencia->fecha</td>";
		 		if($ausencia->aus_fichero != NULL){
		 			echo "<td><a href='../ausencias/$ausencia->aus_fichero'class='btn btn-success'><i class='fa fa-download' aria-hidden='true'></i>&nbsp;&nbsp;Descargar</a></td>";
		 		} else {
		 			echo "<td>Sin justificante</td>";
		 		}
		 		echo "<td></td>";
		 	echo "</tr>";
			echo "</table>";
			echo "<br><br>";
			}

	} else {
		echo "<div class='col-sm-12'>";
		echo "<p>Sin alumnos con ausencias</p>";
		echo "</div>";
	}

 ?>