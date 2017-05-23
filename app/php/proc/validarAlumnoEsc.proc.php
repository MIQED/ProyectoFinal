<?php 
	session_start();
	include '../restriccion/restriccion.proc.php';
	include '../../../bd_con/conexion.php';	

	$observacion = $_POST['observacion'];
	$alumnoid = $_POST['alumnoid'];
	$totalHoras = $_POST['totalHoras'];
	$mes = $_POST['mes'];

	$convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $alumnoid";
	$convenios = mysqli_query($conexion, $convenio_sql);
	while ($convenio = mysqli_fetch_object($convenios)) {
		$convenio_id = $convenio->con_id;
	}

	$sql = "UPDATE validacion SET val_validado = '2', val_observacionEsc='$observacion' WHERE val_convenioid=$convenio_id AND val_mes = $mes";
	mysqli_query($conexion, $sql);
	header('location:../tutor_escuela.php');
 ?>