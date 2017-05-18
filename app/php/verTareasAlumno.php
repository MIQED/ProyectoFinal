<?php 
	
	include '../../bd_con/conexion.php';
	session_start();

	$ciclo_sql = "SELECT * FROM alumno WHERE alu_id=$_SESSION[al]";
	$ciclos_al = mysqli_query($conexion, $ciclo_sql);
	while ($ciclo_al = mysqli_fetch_object($ciclos_al)) {
		$ciclo = $ciclo_al->alu_cicloid;
	}


	$dia = $_GET['dia'];
	$dia_t = str_replace('/', '-', $dia);
	$dia_t = date('Y-m-d', strtotime($dia_t));

	$convenio_sql = "SELECT * FROM convenio INNER JOIN horario_convenio ON horario_convenio.hr_convenioid = convenio.con_id WHERE con_alumnoid = $_SESSION[al]";
	$convenios = mysqli_query($conexion, $convenio_sql);
	while ($convenio = mysqli_fetch_object($convenios)) {
		$horasConvenio = $convenio->hr_hora_final - $convenio->hr_hora_inicio;
		$convenioid = $convenio->con_id;
	}

	$horasAusencia = $horasConvenio;

			$ausencia_sql = "SELECT * FROM ausencia WHERE aus_convenioid = '$convenioid' AND fecha = '$dia_t'";
		 	$ausencias = mysqli_query($conexion, $ausencia_sql);
		 	if (mysqli_num_rows($ausencias)>0){
		 		while ($ausencia = mysqli_fetch_object($ausencias)) {
		 			
			 	$motivo = $ausencia->aus_motivo;
		 		$horas	= $ausencia->aus_horas;
		 		$horasAusencia = $horasAusencia - $horas;
		 		}
		 	}

	$num_tareas_sql = "SELECT * FROM tipo_tarea INNER JOIN tipo_h_tarea ON tipo_h_tarea.tip_tar_id = tipo_tarea.tt_tiphtarid WHERE tt_cicloid = $ciclo";
	$num_tareas = mysqli_query($conexion, $num_tareas_sql);
	$num_tareas = mysqli_num_rows($num_tareas);

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<script src="../js/jquery-3.1.1.min.js"></script>
 	<title></title>
 	<script type="text/javascript">
 	
 	var cont;

 	function validarFormulario (){
 		if (cont != <?php echo $horasAusencia; ?>){
 			document.getElementById('advertencia').innerHTML = "Introduce un numero de horas correcto";
 			return false;
 		}
 		return true;
 	}

 	function limpiarButton(id){
 		// alert(id);
 		 var ele = document.getElementsByName(id);
		  for(i=0;i<ele.length;i++){
	      	ele[i].checked = false;
		 }
		 totalHoras();
 	}

o 	$('#contador').html('<h3>Total de horas: '+cont+'</h3>'); 
 	}
 	

 	</script>
 </head>
 <script type="text/javascript"></script>
 <body>
 <a href="verAlumno.php">Volver al calendario</a>
 	<?php 
 		echo "<h1>Tareas dia $dia</h1>";

 		echo "<div id='contador'></div>";

 		if(isset($motivo)){
 			echo "<h3>Ausencia</h3>";
	 		echo "Motivo ausencia<br>";
	 		echo "$motivo<br><br>";
	 		echo "Adjuntar fichero: <input type='file' name='fichero'/><br><br>";
			echo "Numero de horas: $horas<br><br><br>";
		 	}

 	$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $ciclo";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 				
	 				echo "$tipo_tar->tip_tar_descripcion<br>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {


	 				$tar_sql = "SELECT * FROM tarea INNER JOIN convenio ON tarea.tar_convenioid = convenio.con_id WHERE con_alumnoid='$_SESSION[al]' AND tar_tiptareaid = '$tarea->tt_id' AND tar_fecha='$dia_t'";
	 				$tars = mysqli_query($conexion, $tar_sql);

	 				if (mysqli_num_rows($tars)>0){
	 				while($tar = mysqli_fetch_object($tars)){
	 						echo "<p style='background-color:lime'>$tarea->tt_descripcion<b>$tar->tar_duracion</b></p>";
	 					}
	 				} else {
	 					echo "<p>$tarea->tt_descripcion<b>0</b></p>";
	 				}
	 	
	 			}
	 			echo "<br><br>";

 		}
 		?>
 </body>
 </html>