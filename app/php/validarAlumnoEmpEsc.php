<?php 

	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';

$alumnoid = $_GET['id'];
$mes = $_GET['mes'];

$ciclo_sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE alu_id = $alumnoid";
// echo "$ciclo_sql";
$ciclos = mysqli_query($conexion, $ciclo_sql);
while ($ciclo = mysqli_fetch_object($ciclos)) {
	$cicloid = $ciclo->cic_id;
	$nombre = $ciclo->alu_nombre;
	$apellido1 = $ciclo->alu_apellido1;
	$apellido2 = $ciclo->alu_apellido2;
 } 

 $convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $alumnoid";
	$convenios = mysqli_query($conexion, $convenio_sql);
	while ($convenio = mysqli_fetch_object($convenios)) {
		$convenio_id = $convenio->con_id;
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
<div><a href="tutor_empresa.php">Volver</a></div>
 <div><a href="proc/logout.proc.php">Cerrar sessión</a></div>
<?php 
echo "<h1>Validar alumno: $nombre $apellido1 $apellido2</h1>";
echo "<div id='validar' style='color:red'></div>";
	echo "<form id='form' method='POST' action='proc/validarAlumnoEsc.proc.php' onsubmit='return validar();'>";

	$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $cicloid";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 				
	 				echo "<b>$tipo_tar->tip_tar_descripcion</b><br>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {

	 				$tar_sql = "SELECT * FROM validar_tarea INNER JOIN validacion ON validacion.val_id = validar_tarea.vt_validacionid WHERE val_convenioid='$convenio_id' AND vt_tipotareaid = '$tarea->tt_id' AND val_mes='$mes'";
	 				$tars = mysqli_query($conexion, $tar_sql);

	 				while($tar = mysqli_fetch_object($tars)){
	 					echo "<p>$tarea->tt_descripcion <b>$tar->vt_totalHoras</b></p>";
	 					echo "<p>$tar->vt_notaEmpresa</p>";
	 				}
	 		
	 	
	 			}

	 			echo "<br><br>";
 		}

 		$sql = "SELECT * FROM validacion WHERE val_mes='$mes' AND val_convenioid='$convenio_id'";
 		$results = mysqli_query($conexion, $sql);
 		while ($result = mysqli_fetch_object($results)) {
	 		echo "<b>Observaciones empresa</b><br>";
	 		if ($result->val_observacionEmp != ""){
	 			echo "<p>$result->val_observacionEmp</p>";
	 		} else {
	 			echo "<p>Sin observaciones</p>";
	 		}
 		}

 		echo "<br><br>";

 		echo "Observaciones<br>";
 		echo "<textarea name='observacion' cols='200' rows='7'></textarea>";
 		echo "<input type='hidden' name='alumnoid' value='$alumnoid'/>";
 		echo "<input type='hidden' name='totalHoras' value='$num_tareas'/>";
 		echo "<input type='hidden' name='mes' value='$mes'/>";
 		echo "<br><input type='submit' name='enviar' value='Validar'/>";
 		echo "</form>";
 ?>
</body>
</html>