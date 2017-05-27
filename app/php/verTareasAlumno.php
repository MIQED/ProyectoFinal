<?php 
	
	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';

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
		 		$file = $ausencia->aus_fichero;
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
 	<link rel="stylesheet" type="text/css" href="../css/calendar.css">
  	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon_app.ico">
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet/less" type="text/css" href="../less/alumno.less">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../less/less.js"></script>

	<!-- menu -->
  	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="../js/menu.js"></script>
	<!-- fin menu -->

	<title>HOURJOB</title>
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
 <div class="all">
	<header class="head-app">
		<div class="container">	
				<div class="col-sm-3 col-xs-6">
					<a href="tutor_escuela.php"><img src="../img/logo-app-hourjob.png" class="head-logo grow"></a>
				</div>
				<div class="col-sm-3 head-txt col-xs-4">
					Tutor Escuela
				</div>

				<div class="col-xs-2 menu_bar">
					<a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</div>
				
				<div class="col-sm-offset-3 col-sm-3 head-opc"> 
					<nav>
						<ul>
								<li><a href="verAlumno.php" onclick="enviarHome();"><i class="fa fa-calendar-o fa-2x" aria-hidden="true" title="Calendario"></i></a></li>	
								
								<!-- <li><a href="perfilAlumno.php" onclick="enviarDatos();"><i class="fa fa-user fa-2x" aria-hidden="true" title="Perfil"></i></a></li>
								 -->
								<li><a href="proc/logout.proc.php"><i class="fa fa-power-off fa-2x" style="color: #E74C3C" aria-hidden="true" title="Cerrar Sesión"></i></a></li>

						</ul>
					</nav>
				</div>
		</div>
	</header>
<br><br>
 	<?php 

echo "<div class='container'>";
	echo "<div class='col-sm-12'>";
		echo "<div class='col-sm-6'>";
			echo "<div class='col-sm-12'>";
				echo "<p class='sub-fct fuente'>TAREAS DEL DÍA <span class='sub-fct-azul'>$dia</span></p>";
			echo "</div>";

	 	$al_sql = "SELECT * FROM alumno WHERE alu_id=$_SESSION[al]";
		$alumnos = mysqli_query($conexion, $al_sql);
		while($alumno = mysqli_fetch_object($alumnos)){

			echo "<div class='col-sm-12'>";
				echo "<p class='sub-fct fuente'>Alumno: $alumno->alu_nombre $alumno->alu_apellido1 $alumno->alu_apellido2</p>";
			echo "</div>";		
		}
		echo "</div>";

	 		echo "<div id='contador'></div>";

	 		if(isset($motivo)){
	 			echo "<div class='col-sm-offset-6'>";
				echo "<div class='col-sm-12 ausencia'>";
		 			echo "<h3><b>Ausencia</b></h3>";
			 		echo "<b>Motivo ausencia</b><br>";
			 		echo "$motivo<br><br>";
			 		echo "<div class='col-sm-6 center'>";
			 			echo "<b>Horas faltadas:</b><span style='color:red'> $horas h</span>	<br><br>";
			 		echo "</div>";
			 		echo "<div class='col-sm-6 center'>";
			 		if ($file != NULL){
						echo "<a href='../ausencias/$file' class='btn btn-success'><i class='fa fa-download' aria-hidden='true'></i>&nbsp;&nbsp;Descargar justificante</a><br><br>";
			 		} else {
			 			echo "<a href='#' class='btn btn-success' disabled='disabled'><i class='fa fa-download' aria-hidden='true'></i>&nbsp;&nbsp;Descargar justificante</a><br><br>";
			 		}
					echo "</div>";	
				echo "</div>";
				echo "</div>";

			 	}
	echo "</div>";	 	
echo "</div>";
echo "<br>";
echo "<div class='container'>";
echo "<div class='text-normal'>";
	echo "<table class='table'>";
 	$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $ciclo";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 				
	 				echo "<tr class='info'>";
	 				echo "<td><b style='font-size:15px'>$tipo_tar->tip_tar_descripcion</b></td>";
	 				echo "</tr>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {


	 				$tar_sql = "SELECT * FROM tarea INNER JOIN convenio ON tarea.tar_convenioid = convenio.con_id WHERE con_alumnoid='$_SESSION[al]' AND tar_tiptareaid = '$tarea->tt_id' AND tar_fecha='$dia_t'";
	 				$tars = mysqli_query($conexion, $tar_sql);

	 				if (mysqli_num_rows($tars)>0){
	 				echo "<tr>";	
	 				while($tar = mysqli_fetch_object($tars)){
	 					 	echo "<td><p style='background-color:#82E0AA'>$tarea->tt_descripcion</p></td><td><p><b>$tar->tar_duracion</b></p></td>";
	 						// echo "<p style='background-color:lime'>$tarea->tt_descripcion<b>$tar->tar_duracion</b></p>";
	 					}
	 				} else {
	 					echo "<td><p>$tarea->tt_descripcion</p></td><td><p><b>0</b></p></td>";
	 				}
	 				echo "</tr>";
	 			}

 		}
 		echo "</table>";

 		echo "<br><br>";
 	echo "</div>";
echo "</div>";
 		?>
 		</div>
 </body>
 </html>