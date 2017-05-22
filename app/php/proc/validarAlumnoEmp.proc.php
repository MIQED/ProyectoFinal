<?php 

include '../../../bd_con/conexion.php';	
session_start();


$alumnoid = $_POST['alumnoid'];
$totalHoras = $_POST['totalHoras'];
$mes = $_POST['mes'];

$year = date('Y');
$dia = "$year-$mes-1"; 

$convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $alumnoid";
	$convenios = mysqli_query($conexion, $convenio_sql);
	while ($convenio = mysqli_fetch_object($convenios)) {
		$convenio_id = $convenio->con_id;
	}
	for ($i=1; $i <= $totalHoras; $i++) { 
		$notaEmp = $_POST[''.$i.''];
		$comprobar_sql = "SELECT * FROM tarea WHERE tar_convenioid = $convenio_id AND  tar_tiptareaid = '$i' AND MONTH(tar_fecha) = '$mes'";
		$comprobar = mysqli_query($conexion, $comprobar_sql);
		if(mysqli_num_rows($comprobar)>0){
			$sql = "UPDATE tarea SET tar_notaEmpresa = '$notaEmp' WHERE tar_convenioid = $convenio_id AND tar_tiptareaid = '$i' AND MONTH(tar_fecha) = '$mes'";
			mysqli_query($conexion, $sql);
		} else {
			$sql = "INSERT INTO `tarea` (`tar_id`, `tar_duracion`,  `tar_fecha`, `tar_convenioid`, `tar_tiptareaid`, tar_notaEmpresa) VALUES (NULL, '0', '$dia', '$convenio_id', '$i', '$notaEmp')";
			mysqli_query($conexion, $sql);
		}
	}
	$sql = "UPDATE validacion SET val_validado='1' WHERE val_convenioid=$convenio_id AND val_mes = $mes";
	mysqli_query($conexion, $sql);
	header('location:../tutor_empresa.php');

 ?>