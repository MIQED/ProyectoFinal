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

	$day = date("d");
	$mes  = date("m");
	$ano = date('Y');

		if (strstr($mes, '0')){
			$mes = substr($mes, -1);
		}	

$hoy = "$day/$mes/$ano";

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<script src="../js/jquery-3.1.1.min.js"></script>
 	<title></title>
 	<script type="text/javascript">
 	
 	var cont;
 	var horasConvenio = <?php echo $horasConvenio; ?>;

 	function validarFormulario (){
 		var msg = "";
 		if (cont != horasConvenio){
 			 msg = "Introduce un numero de horas correcto <br>";
 		} 
 		if(document.getElementById('select').value != 0){
 			if (document.getElementById('motivo').value == "") {
 				msg += "Si has faltado alguna hora tienes que poner el motivo";
 				document.getElementById('motivo').style.borderColor = "red";
 			}
 		}

 		if (msg != ""){
 			document.getElementById('advertencia').innerHTML = msg;
 			return false;
 		} else {
 			return true;
 		}

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

		$('#select').on('change', function(){
			horasConvenio = <?php echo $horasConvenio; ?>;
			horasConvenio = horasConvenio - this.value;
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

 	echo "<form id='form' action='proc/insertTareasAlumno.proc.php' method='POST' enctype='multipart/form-data' onsubmit='return validarFormulario();'>";

 	echo "<h3>Ausencia</h3>";
 		echo "Motivo ausencia<br>";
 		echo "<textarea id='motivo' type='text' name='motivo' cols='150' rows='4'></textarea><br><br>";
 		echo "Adjuntar fichero: <input type='file' name='fichero'/><br><br>";
 		echo "Numero de horas: ";
 			echo "<select id='select' name='falta'>";
 				for ($i=0; $i <= $horasConvenio ; $i++) {
 					if($i != 0){
 						echo "<option value='$i'>$i</option>";
 					} else{
 						echo "<option value='$i'>- - -</option>";
 					}
 				}
 			echo "</select><br><br><br>";

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
 		if ($hoy >= $dia){
 			echo "<input type='submit' name='enviar' value='Guardar'/>";
 		}
 		if ($hoy > $dia){
 			echo "<input type='submit' name='enviar' value='Guardar y seguir'/>";
 		}
 		echo "</form>";

 	 ?>
 </body>
 </html>