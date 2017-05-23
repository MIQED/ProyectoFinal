<?php 

	include '../../bd_con/conexion.php';
	session_start();

$mes = $_GET['mes'];

	if (isset($_SESSION['ciclo'])){
		$cicloid = $_SESSION['ciclo'];
	} else {
		$ciclo_sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE alu_id = $_SESSION[al]";
			$ciclos = mysqli_query($conexion, $ciclo_sql);
			while ($ciclo = mysqli_fetch_object($ciclos)) {
				$cicloid = $ciclo->cic_id;
			 } 
	}


	if (isset($_SESSION['convenio'])){
		$convenioid = $_SESSION['convenio'];
	} else {
		$convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $_SESSION[al]";
		$convenios = mysqli_query($conexion, $convenio_sql);
		while ($convenio = mysqli_fetch_object($convenios)) {
			$convenioid = $convenio->con_id;
		}
	}

 $num_tareas_sql = "SELECT * FROM tipo_tarea INNER JOIN tipo_h_tarea ON tipo_h_tarea.tip_tar_id = tipo_tarea.tt_tiphtarid WHERE tt_cicloid = $cicloid";
	$num_tareas = mysqli_query($conexion, $num_tareas_sql);
	$num_tareas = mysqli_num_rows($num_tareas);

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php 
	if (isset($_SESSION['convenio'])){
		echo '<div><a href="alumno.php">Volver</a></div>';
	} else {
		echo '<div><a href="verAlumno.php">Volver</a></div>';
	}	
 ?>
<?php 
echo "<h1>Validacion mes de $mes</h1>";

	$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $cicloid";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 				
	 				echo "<b>$tipo_tar->tip_tar_descripcion</b><br>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {

	 				$tar_sql = "SELECT * FROM validar_tarea INNER JOIN validacion ON validacion.val_id = validar_tarea.vt_validacionid WHERE val_convenioid='$convenioid' AND vt_tipotareaid = '$tarea->tt_id' AND val_mes='$mes'";
	 				$tars = mysqli_query($conexion, $tar_sql);

	 				while($tar = mysqli_fetch_object($tars)){
	 					echo "<p>$tarea->tt_descripcion <b>$tar->vt_totalHoras</b></p>";
	 					echo "<p>$tar->vt_notaEmpresa</p>";
	 				}
	 		
	 	
	 			}

	 			echo "<br><br>";
 		}
 ?>
</body>
</html>