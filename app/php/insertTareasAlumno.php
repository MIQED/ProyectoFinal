<?php 
	
	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';
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


$hoy = "$day-$mes-$ano";
$hoy = date('Y-m-d', strtotime($hoy));

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<link rel="stylesheet" type="text/css" href="../css/calendar.css">
  	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon_app.ico">
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet/less" type="text/css" href="../less/alumno.less">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../less/less.js"></script>
	<title>HOURJOB</title>
 	<script type="text/javascript">
 	
 	var cont;
 	var horasConvenio = <?php echo $horasConvenio; ?>;


 	function validarFormulario (){
 		var msg = "";
 		if (cont != horasConvenio){
 			 msg = "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;&nbsp;Introduce un número de horas correcto ("+horasConvenio+")<br>";
 		} 
 		if(document.getElementById('select').value != 0){
 			if (document.getElementById('motivo').value == "") {
 				msg += "<i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;&nbsp;Si has faltado alguna hora, indícanos el motivo de tu ausencia.";
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
   		 			value = parseInt(value);
   		 			cont=cont+value
   		 		}; 
   		 	};
   		 	$('#contador').html('Total de horas: <span class="sub-fct-azul">'+cont+'</span>'); 
 	}
 	

 	</script>
 </head>
 <script type="text/javascript"></script>
 <body>
 <div class="all">
	<header class="head-app">
		<div class="container">	
				<div class="col-sm-3 col-xs-6">
					<a href="alumno.php"><img src="../img/logo-app-hourjob.png" class="head-logo grow"></a>
				</div>
				<div class="col-sm-3 head-txt col-xs-4">
					Alumno
				</div>

				<div class="col-xs-2 menu_bar">
					<a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</div>
				
				<div class="col-sm-offset-3 col-sm-3 head-opc"> 
					<nav>
						<ul>
								<!-- <li><a href="alumno.php" onclick="enviarHome();"><i class="fa fa-calendar-o fa-2x" aria-hidden="true" title="Inicio"></i></a></li>	
								
								<li><a href="perfilAlumno.php" onclick="enviarDatos();"><i class="fa fa-user fa-2x" aria-hidden="true" title="Perfil"></i></a></li> -->
								
								<li><a href="proc/logout.proc.php"><i class="fa fa-power-off fa-2x" style="color: #E74C3C" aria-hidden="true" title="Cerrar Sesión"></i></a></li>

						</ul>
					</nav>
				</div>
		</div>
	</header>
<div class="container">
<div class="col-sm-12 center pad-p">
	
	 <a href="alumno.php" type="button" class="btn btn-default"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;&nbsp;Volver</a>
	
 </div>
 </div>
 	<?php 

echo "<div class='container'>";

 	echo "<form id='form' action='proc/insertTareasAlumno.proc.php' method='POST' enctype='multipart/form-data' onsubmit='return validarFormulario();'>";

	echo "<div class='horas-fixed'>";
		echo "<div class='col-sm-12'>";
	 		echo "<p class='sub-fct'>Tareas del día <span class='sub-fct-azul'>$dia</span></p>";
		echo "</div>";
		echo "<div class='col-sm-12'>";
	 		echo "<p id='contador' class='sub-fct'></p>";
	 	echo "</div>";	
	 	echo "<div class='col-sm-12'>";
	 		echo "<p id='advertencia' style='color:red; font-size:15px'></p>";
	 	echo "</div>";
	 	echo "<div class='col-sm-12'>";
	 		$dia = str_replace('/', '-', $dia);
			$dia = date('Y-m-d', strtotime($dia));
	 		if ($hoy >= $dia){
	 			echo "<input class='btn btn-success' type='submit' name='enviar' value='Guardar'/>&nbsp;&nbsp;";
	 		}
	 		if ($hoy > $dia){
	 			echo "<input class='btn btn-info' type='submit' name='enviar' value='Guardar y seguir'/>";
	 		}
	 	echo "</div>";
 	echo "</div>";

echo "<div class='col-sm-offset-2 col-sm-10'>";
 		$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $_SESSION[ciclo]";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);



 	echo "<div class='col-sm-12 ausencia'>";
 		echo "<h3><b>Ausencia</b></h3>";
 		echo "<b>Motivo ausencia</b><br>";
 		echo "<textarea id='motivo' type='text' class='form-control' name='motivo' cols='120' rows='4'></textarea><br><br>";
 		echo "<b>Adjuntar fichero:</b> <input type='file' name='fichero'/><br><br>";
 		echo "<b>Número de horas:</b> ";
 			echo "<select id='select' name='falta' class='form-control'>";
 				for ($i=0; $i <= $horasConvenio ; $i++) {
 					if($i != 0){
 						echo "<option value='$i'>$i</option>";
 					} else{
 						echo "<option value='$i'>- - -</option>";
 					}
 				}
 			echo "</select><br>";
 	echo "</div>";

 	echo "<table class='table'>";
 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			

 				echo "<tr class='info' style='border-radius:10px'>";
	 				echo "<td colspan='$horasConvenio'><b style='font-size:15px;'>$tipo_tar->tip_tar_descripcion</b></td>";
	 			echo "</tr>";

	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);

	 			while ($tarea = mysqli_fetch_object($tareas)) {

	 				echo "<tr>";
	 				echo "<td colspan='$horasConvenio'>$tarea->tt_descripcion</td>";
	 				echo "</tr>";
	 				echo "<tr>";
	 						for ($i=1; $i <= $horasConvenio; $i++) { 
	 							echo "<td>";
	 							echo "<input id='$tarea->tt_id' type='radio' name='$tarea->tt_id' value='$i'/>  $i h  ";
	 							echo "</td>";
	 						}
	 						echo "<td>";
	 						echo "<a class='btn btn-danger' onclick='limpiarButton($tarea->tt_id);'><i class='fa fa-undo' aria-hidden='true'></i></a><br>";
	 						echo "</td>";
	 	
	 			}
	 			echo "<br><br>";

 		}

 	echo "</table>";
 		echo "<input type='hidden' name='totalHoras' value='$num_tareas'/>";
 		echo "<input type='hidden' name='dia' value='$dia'/>";
 		
 		echo "</form>";
 		echo "</div>";
echo "</div>";
 	 ?>
 	 </div>
 </body>
 </html>