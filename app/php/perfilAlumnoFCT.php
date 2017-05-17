<?php 

include '../../bd_con/conexion.php';
session_start();
$id = $_SESSION['id'];

echo "<h1>Datos escuela</h1>";
	$escuelas_sql = "SELECT * FROM tutor_escuela INNER JOIN ciclo on ciclo.cic_tutescid = tutor_escuela.tut_esc_id WHERE cic_id = $_SESSION[ciclo] ";
	$escuelas = mysqli_query($conexion, $escuelas_sql);
	while ($escuela = mysqli_fetch_object($escuelas)){
		echo "<b>Nombre</b>: $escuela->tut_esc_nombre<br>";
		echo "<b>Apellidos</b>: $escuela->tut_esc_apellido1 $escuela->tut_esc_apellido2<br>";
		echo "<b>Correo</b>: $escuela->tut_esc_email<br>";
		echo "<b>Telf</b>: $escuela->tut_esc_telf<br>";
		//añadir datos de la escuela
	}

	echo "<h1>Datos empresa</h1>";
	$empresa_sql = "SELECT * FROM convenio INNER JOIN empresa ON empresa.emp_id = convenio.con_empresaid INNER JOIN tutor_empresa ON tutor_empresa.tut_emp_empresaid = empresa.emp_id WHERE con_alumnoid = $id";
	// echo "$empresa_sql";
	$empresas = mysqli_query($conexion, $empresa_sql);
	while ($empresa = mysqli_fetch_object($empresas)) {
		echo "<b>Nombre</b>: $empresa->tut_emp_nombre<br>";
		echo "<b>Apellidos</b>: $empresa->tut_emp_apellido1 $empresa->tut_emp_apellido2<br>";
		echo "<b>Correo</b>: $empresa->tut_emp_email<br>";
		echo "<b>Telf</b>: $empresa->tut_emp_telf<br>";
	}	
	//añadir datos de la empresa

	echo "<h1>Horas por tarea</h1>";
		$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $_SESSION[ciclo]";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 				
	 				echo "$tipo_tar->tip_tar_descripcion<br>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {


	 				$tar_sql = "SELECT SUM(tar_duracion) as horas FROM tarea INNER JOIN convenio ON tarea.tar_convenioid = convenio.con_id WHERE con_alumnoid='$id' AND tar_tiptareaid = '$tarea->tt_id'";
	 				$tars = mysqli_query($conexion, $tar_sql);

	 				while($tar = mysqli_fetch_object($tars)){
	 					if ($tar->horas != null){	
	 						echo "<p>$tarea->tt_descripcion<b>$tar->horas</b></p>";
	 					} else {
	 						echo "<p>$tarea->tt_descripcion<b>0</b></p>";
	 					}
	 				}
	 	
	 			}
	 			echo "<br><br>";

 		}

//Horas realizadas + horas totales + horas restantes +  ver horas realizadas en cada tarea
?>