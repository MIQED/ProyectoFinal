<?php 
	
	include '../../bd_con/conexion.php';
	session_start();
	$dia = $_GET['dia'];


	$convenio_sql = "SELECT * FROM convenio INNER JOIN horario_convenio ON horario_convenio.hr_convenioid = convenio.con_id WHERE con_alumnoid = $_SESSION[id]";
	$convenios = mysqli_query($conexion, $convenio_sql);
	while ($convenio = mysqli_fetch_object($convenios)) {
		$horasConvenio = $convenio->hr_hora_final - $convenio->hr_hora_inicio;
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
 		if (cont != 4){
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
 	<?php 
 		echo "<h1>Tareas dia $dia</h1>";

 		echo "<div id='contador'></div>";

 		echo "<div id='advertencia' style='color:red'></div>";

 		$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $_SESSION[ciclo]";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 	echo "<form id='form' action='proc/insertTareasAlumno.proc.php' method='POST' onsubmit='return validarFormulario();'>";

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			

	 			echo "$tipo_tar->tip_tar_descripcion<br><br>";

	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);

	 			while ($tarea = mysqli_fetch_object($tareas)) {

	 				echo "$tarea->tt_descripcion<br>";

	 						for ($i=1; $i <= $horasConvenio; $i++) { 
	 							echo "$i h  <input id='$tarea->tt_id' type='radio' name='$tarea->tt_id' value='$i'/>";
	 						}
	 						echo "<a href='#' onclick='limpiarButton($tarea->tt_id);'>Deshacer</a><br>";
	 	
	 			}
	 			echo "<br><br>";

 		}
 		echo "<input type='hidden' name='totalHoras' value='$num_tareas'/>";
 		echo "<input type='hidden' name='dia' value='$dia'/>";
 		echo "<input type='submit' name='enviar' value='Enviar'/>";

 		echo "</form>";

 	 ?>
 </body>
 </html>