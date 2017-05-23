<?php 
	
	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';

	$dia = $_GET['dia'];
	$dia_t = str_replace('/', '-', $dia);
	$dia_t = date('Y-m-d', strtotime($dia_t));

	$convenio_sql = "SELECT * FROM convenio INNER JOIN horario_convenio ON horario_convenio.hr_convenioid = convenio.con_id WHERE con_alumnoid = $_SESSION[id]";
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

	$num_tareas_sql = "SELECT * FROM tipo_tarea INNER JOIN tipo_h_tarea ON tipo_h_tarea.tip_tar_id = tipo_tarea.tt_tiphtarid WHERE tt_cicloid = $_SESSION[ciclo]";
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

 	$(document).ready(function(){
 		totalHoras();	
 		$('#form').on('change', function(){
 			totalHoras();
		});
 		
 	});
 	

 	function totalHoras(){
 		cont = 0;
 			for (var i = 1; i <= <?php echo "$num_tareas"; ?>; i++) {
 				var value = $('input[name='+i+']:checked', '#form').val();
   		 		if(value){
   		 			if (value == 1) {
   		 				cont = cont + 1;
   		 			} else if (value==2){
   		 				cont = cont + 2;
   		 			} else if (value==3){
   		 				cont = cont + 3;
   		 			} else {
   		 				cont = cont + 4;
   		 			}
   		 		}; 
   		 	};
   		 	$('#contador').html('<h3>Total de horas: '+cont+'</h3>'); 
 	}
 	

 	</script>
 </head>
 <script type="text/javascript"></script>
 <body>
 <a href="alumno.php">Volver al calendario</a>
 	<?php 
 		echo "<h1>Tareas dia $dia</h1>";

 		echo "<div id='contador'></div>";

 		echo "<div id='advertencia' style='color:red'></div>";

 		$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $_SESSION[ciclo]";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 	echo "<form id='form' action='proc/updateTareasAlumno.proc.php' method='POST'  enctype='multipart/form-data' onsubmit='return validarFormulario();'>";

 		if(isset($motivo)){
 			echo "<h3>Ausencia</h3>";
	 		echo "Motivo ausencia<br>";
	 		echo "$motivo<br><br>";
	 		echo "Adjuntar fichero: <input type='file' name='fichero'/><br><br>";
			echo "Numero de horas: $horas<br><br><br>";
		 	}

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			

	 			echo "$tipo_tar->tip_tar_descripcion<br><br>";

	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);

	 			while ($tarea = mysqli_fetch_object($tareas)) {

	 				echo "$tarea->tt_descripcion<br>";

	 					$checks_sql = "SELECT * FROM tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_id = tarea.tar_tiptareaid WHERE tt_cicloid = $_SESSION[ciclo] AND tar_tiptareaid = '$tarea->tt_id' AND tar_fecha='$dia_t'";
	 					$checks = mysqli_query($conexion, $checks_sql);
	 					// echo "$checks_sql<br>";	

	 					if (mysqli_num_rows($checks)>0){
	 						while ($check = mysqli_fetch_object($checks)) {
	 							for ($i=1; $i <= $horasConvenio; $i++) { 
	 								if ($check->tar_duracion == $i){	
				 						echo "$i h  <input id='$tarea->tt_id' type='radio' name='$tarea->tt_id' value='$i' checked/>";
	 								}	else {
	 									echo "$i h  <input id='$tarea->tt_id' type='radio' name='$tarea->tt_id' value='$i'/>";
	 								}	
				 				}
	 						}
	 					}else {
	 						for ($i=1; $i <= $horasConvenio; $i++) { 
	 							echo "$i h  <input id='$tarea->tt_id' type='radio' name='$tarea->tt_id' value='$i'/>";
	 						}
	 					}
	 						echo "<a href='#' onclick='limpiarButton($tarea->tt_id);'>Deshacer</a><br>";
	 	
	 			}
	 			echo "<br><br>";

 		}
 		echo "<input type='hidden' name='totalHoras' value='$num_tareas'/>";
 		echo "<input type='hidden' name='dia' value='$dia'/>";
 		echo "<input type='submit' name='enviar' value='Guardar'/>";

 		echo "</form>";

 	 ?>
 </body>
 </html>