<?php 

	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';

$mes = $_GET['mes'];

	if (isset($_SESSION['ciclo'])){
		$cicloid = $_SESSION['ciclo'];
	} else {
		$ciclo_sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE alu_id = $_SESSION[al]";
			$ciclos = mysqli_query($conexion, $ciclo_sql);
			while ($ciclo = mysqli_fetch_object($ciclos)) {
				$cicloid = $ciclo->cic_id;
			 } 
	}


	if (isset($_SESSION['convenio'])){
		$convenioid = $_SESSION['convenio'];
	} else {
		$convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $_SESSION[al]";
		$convenios = mysqli_query($conexion, $convenio_sql);
		while ($convenio = mysqli_fetch_object($convenios)) {
			$convenioid = $convenio->con_id;
		}
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
	<title>HOURJOB</title>
</head>
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
<?php 
	if (isset($_SESSION['convenio'])){
		echo '<div><a href="alumno.php" type="button" class="btn btn-default"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;&nbsp;Volver</a></div>';
	} else {
		echo '<div><a href="verAlumno.php" type="button" class="btn btn-default"><i class="fa fa-angle-double-left" aria-hidden="true"></i>&nbsp;&nbsp;Volver</a></div>';
	}	
 ?>	
 </div>
 </div>
<?php 
$meses = array('enero','febrero','marzo','abril','mayo','junio','julio',
               'agosto','septiembre','octubre','noviembre','diciembre');

if (strstr($mes, '0')){
		$mes_0 = substr($mes, -1);
	} else {
		$mes_0 = $mes;
	}
		$mes_0 = $mes_0-1;

$mes_d = $meses[$mes_0];
echo "<div class='container'>";
echo "<div class='col-sm-12'>";

echo "<p class='sub-fct'>Validación mes de <span class='sub-fct-azul'>$mes_d</span></p>";

echo "<div class='text-normal'>";
echo "<table class='table'>";
echo "<tr>";
echo "<td style='width:80%'></td>";
echo "<td  class='center info' style='width:10%'>Horas</td>";
echo "<td  class='center info' style='width:10%'>Valoración</td>";
echo "</tr>";
	$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $cicloid";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 			
	 				echo "<tr class='info'>";
	 				echo "<td><b style='font-size:15px'>$tipo_tar->tip_tar_descripcion</b></td>";
	 				echo "</tr>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {

	 				$tar_sql = "SELECT * FROM validar_tarea INNER JOIN validacion ON validacion.val_id = validar_tarea.vt_validacionid WHERE val_convenioid='$convenioid' AND vt_tipotareaid = '$tarea->tt_id' AND val_mes='$mes'";
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

echo "<br><br><br><br>";
 		$sql = "SELECT * FROM validacion WHERE val_mes='$mes' AND val_convenioid='$convenioid'";
 		$results = mysqli_query($conexion, $sql);
 		while ($result = mysqli_fetch_object($results)) {
	 		echo "<b>Observaciones empresa</b><br>";
	 		if ($result->val_observacionEmp != ""){
	 			echo "<p>$result->val_observacionEmp</p>";
	 		} else {
	 			echo "<p>Sin observaciones</p>";
	 		}
	 		echo "<br>";

	 		echo "<b>Observaciones esuela</b><br>";
	 		if ($result->val_observacionEsc != ""){
	 			echo "<p>$result->val_observacionEsc</p>";
	 		} else {
	 			echo "<p>Sin observaciones</p>";
	 		}
 		}


echo "<br><br>";
echo "</div>";
echo "</div>";
if(!isset($_SESSION["convenio"])){
	echo "<div class='col-sm-12 center'>";
	echo "<a href='pdf.php?mes=$mes' class='btn btn-success' target='blank'><i class='fa fa-download' aria-hidden='true'></i>&nbsp;&nbsp;Descargar PDF</a>";
	echo "</div>";
}
echo "</div>";

 ?>
 <br><br>
 </div>
</body>
</html>