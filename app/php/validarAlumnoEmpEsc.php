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


	 				$tar_sql = "SELECT SUM(tar_duracion) as horas, tar_notaEmpresa FROM tarea INNER JOIN convenio ON tarea.tar_convenioid = convenio.con_id WHERE con_alumnoid='$alumnoid' AND tar_tiptareaid = '$tarea->tt_id' AND MONTH(tar_fecha)='$mes'";
	 				// echo $tar_sql;
	 				$tars = mysqli_query($conexion, $tar_sql);

	 				while($tar = mysqli_fetch_object($tars)){
	 					if ($tar->horas != null){	
	 						echo "<p>$tarea->tt_descripcion<b>$tar->horas</b></p>";
	 					} else {
	 						echo "<p>$tarea->tt_descripcion<b>0</b></p>";
	 					}
	 						
	 						echo "$tar->tar_notaEmpresa";
	 				}

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