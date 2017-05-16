<?php 
	
	include '../../bd_con/conexion.php';

	$dia = $_GET['dia'];

	$num_tareas_sql = "SELECT * FROM tipo_tarea INNER JOIN tipo_h_tarea ON tipo_h_tarea.tip_tar_id = tipo_tarea.tt_tiphtarid";
	$num_tareas = mysqli_query($conexion, $num_tareas_sql);
	$num_tareas = mysqli_num_rows($num_tareas);

	session_start();

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

 	function numHoras(){
 		cont = 0;
 		$('#form').on('change', function(){
 			totalHoras();
		});
 		document.getElementById('contador').innerHTML = '<h3>Total de horas: '+cont+'</h3>';
 	}

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
   		 	document.getElementById('contador').innerHTML = '<h3>Total de horas: '+cont+'</h3>';
 	}
 	

 	</script>
 </head>
 <script type="text/javascript"></script>
 <body onload="numHoras();">
 	<?php 
 		echo "<h1>Tareas dia $dia</h1>";

 		echo "<div id='contador'></div>";

 		echo "<div id='advertencia' style='color:green'></div>";

 		$tipo_tar_sql = "SELECT * FROM tipo_h_tarea";//Una vez echa las relaciones en la base de datos poner en el sql el where donde el id del alumno coincida con la preguntas o relacionarlo con el ciclo
 		$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 	echo "<form id='form' action='proc/horasTareasAlumno.proc.php' method='POST' onsubmit='return validarFormulario();'>";

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			

	 			echo "$tipo_tar->tip_tar_descripcion<br><br>";

	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);

	 			while ($tarea = mysqli_fetch_object($tareas)) {				

	 					echo "$tarea->tt_descripcion<br>";
	 					echo "1h <input id='$tarea->tt_id' type='radio' name='$tarea->tt_id' value='1'/>  2h <input type='radio' name='$tarea->tt_id' value='2'/>  3h <input type='radio' name='$tarea->tt_id' value='3'/>  4h <input type='radio' name='$tarea->tt_id' value='4'/><a href='#' onclick='limpiarButton($tarea->tt_id);'>Deshacer</a><br>";
	 	
	 			}
	 			echo "<br><br>";

 		}
 		echo "<input type='hidden' name='totalHoras' value='$num_tareas'/>";
 		echo "<input type='submit' name='enviar' value='Enviar'/>";

 		echo "</form>";

 	 ?>
 </body>
 </html>