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
</head>
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
								<li><a href="tutor_escuela.php" onclick="enviarHome();"><i class="fa fa-home fa-2x" aria-hidden="true" title="Calendario"></i></a></li>	
								
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
		echo "<p class='sub-fct fuente'>VALIDAR <span class='sub-fct-azul'>ALUMNO:</span> $nombre $apellido1 $apellido2</p>";
	echo "</div>";  
echo "</div>";
echo "<div id='validar' style='color:red'></div>";

echo "<div class='container'>";
echo "<div class='text-normal'>";
echo "<table class='table'>";
echo "<tr>";
echo "<td style='width:80%'></td>";
echo "<td  class='center info' style='width:10%'>Horas</td>";
echo "<td  class='center info' style='width:10%'>Valoración</td>";
echo "</tr>";
	echo "<form id='form' method='POST' action='proc/validarAlumnoEsc.proc.php' onsubmit='return validar();'>";

	$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $cicloid";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 				
	 				echo "<tr class='info'>";
	 				echo "<td><b style='font-size:15px'>$tipo_tar->tip_tar_descripcion</b></td>";
	 				echo "</tr>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {

	 				$tar_sql = "SELECT * FROM validar_tarea INNER JOIN validacion ON validacion.val_id = validar_tarea.vt_validacionid WHERE val_convenioid='$convenio_id' AND vt_tipotareaid = '$tarea->tt_id' AND val_mes='$mes'";
	 				$tars = mysqli_query($conexion, $tar_sql);
	 				echo "<tr>";
	 				while($tar = mysqli_fetch_object($tars)){
	 					echo "<td><p>$tarea->tt_descripcion</p></td><td class='center'><p><b>$tar->vt_totalHoras h</b></p></td>";
	 					if($tar->vt_notaEmpresa == "0"){
 							echo "<td class='center success'><p>NO VALIDADO</p></td>";
	 					} else {
 							echo "<td class='center success'><p>$tar->vt_notaEmpresa</p></td>";

	 					}
	 				}
	 				echo "</tr>";
	 		
	 	
	 			}

 		}
echo "</table>";

echo "<br><br>";
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

 		echo "<b>Observaciones</b><br>";
 		echo "<textarea class='form-control' name='observacion' cols='200' rows='7'></textarea>";
 		 echo "</div>";
 		echo "<input type='hidden' name='alumnoid' value='$alumnoid'/>";
 		echo "<input type='hidden' name='totalHoras' value='$num_tareas'/>";
 		echo "<input type='hidden' name='mes' value='$mes'/>";
 		echo "<div class='container'>";
 		echo "<br><div class='col-sm-12 center'><input class='btn btn-success ' type='submit' name='enviar' value='Validar'/></div>";
 		echo "</div>";
 		echo "</form>";

 ?>
 <br><br>
 </div>
</body>
</html>