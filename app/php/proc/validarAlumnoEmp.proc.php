<?php 

include '../../../bd_con/conexion.php';	
session_start();
include '../restriccion/restriccion.proc.php';

$observacion = $_POST['observacion'];

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
		$sql = "UPDATE validar_tarea INNER join validacion ON validacion.val_id = validar_tarea.vt_validacionid  SET vt_notaEmpresa = '$notaEmp' WHERE val_convenioid = $convenio_id AND vt_tipotareaid = '$i' AND val_mes = '$mes'";
		mysqli_query($conexion, $sql); 
	}

	$sql = "UPDATE validacion SET val_validado='1', val_observacionEmp='$observacion' WHERE val_convenioid ='$convenio_id' AND val_mes = '$mes'";
	echo "$sql";
	mysqli_query($conexion, $sql);

	header('location:../tutor_empresa.php');

 ?>