<?php 


include '../../../bd_con/conexion.php';

session_start(); 
include '../restriccion/restriccion.proc.php';

	$totalHoras = $_POST['totalHoras'];

	$dia = $_POST['dia'];
	$dia = str_replace('/', '-', $dia);
	$dia = date('Y-m-d', strtotime($dia));

	$convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $_SESSION[id]";
	$convenios = mysqli_query($conexion, $convenio_sql);
	while ($convenio = mysqli_fetch_object($convenios)) {
		$convenio_id = $convenio->con_id;
	}


	$fichero = $_FILES['fichero']['name'];

	if ($fichero!=""){

	$ext = strstr($fichero, '.'); 
	$fichero = "".$dia."_".$_SESSION['id'].$ext;
				
	if(!file_exists("../../ausencias")){
						mkdir('../../ausencias', 0777, true);
	} 

		move_uploaded_file($_FILES['fichero']['tmp_name'], "../../ausencias/".$fichero);
		$fichero_sql = "UPDATE `ausencia` SET `aus_fichero` = '$fichero' WHERE fecha = '$dia' AND aus_convenioid='$convenio_id'";
	}

	$delete ="DELETE FROM tarea WHERE tar_fecha = '$dia'";
	mysqli_query($conexion, $delete);

for ($i=0; $i <= $totalHoras; $i++) { 

		if (isset($_POST[''.$i.''])){
			$horasTarea = $_POST[''.$i.''];
			$sql = "INSERT INTO `tarea` (`tar_id`, `tar_duracion`, `tar_fecha`, `tar_convenioid`, `tar_tiptareaid`) VALUES (NULL, '$horasTarea', '$dia', '$convenio_id', '$i')";
			mysqli_query($conexion, $sql);
		}
	}

	header('location:../alumno.php');

?>