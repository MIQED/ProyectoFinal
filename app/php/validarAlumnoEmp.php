<?php 

	include '../../bd_con/conexion.php';
	session_start();

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
	<script type="text/javascript">
		
	function validar(){
		var msg = 0;
			for (i = 1 ; i<=<?php echo $num_tareas; ?>; i++){
				var element = document.getElementById(''+i+'');
				if (element.value == 0 ){
					element.style.borderColor = "red";
					msg=1;
				} else {
					element.style.borderColor = "none";
				}
			}
			if (msg){
				document.getElementById('validar').innerHTML = "Debes validar todas las tareas";
			return false;
			} else {
				return true;
			}
	}

	</script>
</head>
<body>
<?php 
if ($_SESSION['tipo']=="empresa") {	
  echo '<div><a href="tutor_empresa.php">Volver</a></div>';
} else {
	echo '<div><a href="tutor_escuela.php">Volver</a></div>';
}
 ?>
 <div><a href="proc/logout.proc.php">Cerrar sessión</a></div>
<?php 
echo "<h1>Validar alumno: $nombre $apellido1 $apellido2</h1>";
echo "<div id='validar' style='color:red'></div>";
	echo "<form id='form' method='POST' action='proc/validarAlumnoEmp.proc.php' onsubmit='return validar();'>";

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
	 				}
	 						echo "<select id='$tarea->tt_id' name='$tarea->tt_id'>";
	 							echo "<option value='0'>----</option>";
	 							echo "<option value='Excelente'>Excelente</option>";
	 							echo "<option value='Notable'>Notable</option>";
	 							echo "<option value='Suficiente'>Suficiente</option>";
	 							echo "<option value='Insuficiente'>Insuficiente</option>";
	 						echo "</select>";
	 	
	 			}
	 			echo "<br><br>";
 		}
 		echo "<input type='hidden' name='alumnoid' value='$alumnoid'/>";
 		echo "<input type='hidden' name='totalHoras' value='$num_tareas'/>";
 		echo "<input type='hidden' name='mes' value='$mes'/>";
 		echo "<br><input type='submit' name='enviar' value='Validar'/>";
 		echo "</form>";
 ?>
</body>
</html>