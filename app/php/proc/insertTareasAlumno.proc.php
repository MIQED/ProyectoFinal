<?php 


include '../../../bd_con/conexion.php';

session_start(); 
	
	$enviar = $_POST['enviar'];
	$totalHoras = $_POST['totalHoras'];
	$falta = $_POST['falta'];
	$motivo = $_POST['motivo'];

	$dia = $_POST['dia'];
	$dia = str_replace('/', '-', $dia);
	$dia = date('Y-m-d', strtotime($dia));

	$convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $_SESSION[id]";
	$convenios = mysqli_query($conexion, $convenio_sql);
	while ($convenio = mysqli_fetch_object($convenios)) {
		$convenio_id = $convenio->con_id;
	}

	$fichero = $_FILES['fichero']['name'];

	if ($fichero!="" && $falta != 0){

	$ext = strstr($fichero, '.'); 
	$fichero = "".$dia."_".$_SESSION['id'].$ext;
				
	if(!file_exists("../../ausencias")){
						mkdir('../../ausencias', 0777, true);
	} 

		move_uploaded_file($_FILES['fichero']['tmp_name'], "../../ausencias/".$fichero);
		$fichero = "'$fichero'";

	} else {
		$fichero = "NULL";
	}

	if ($falta != 0){
		$ausencia_sql = "INSERT INTO `ausencia` (`aus_id`, `aus_fichero`, `aus_motivo`, `aus_horas`, `fecha`, `aus_convenioid`) VALUES (NULL, $fichero, '$motivo', '$falta', '$dia', '$convenio_id')";
		mysqli_query($conexion, $ausencia_sql);
		if($falta == 4){
			mysqli_query($conexion, $sql);
		}
	}

for ($i=0; $i <= $totalHoras; $i++) { 

		if (isset($_POST[''.$i.''])){
			$horasTarea = $_POST[''.$i.''];
			$sql = "INSERT INTO `tarea` (`tar_id`, `tar_duracion`,  `tar_fecha`, `tar_convenioid`, `tar_tiptareaid`) VALUES (NULL, '$horasTarea', '$dia', '$convenio_id', '$i')";

			mysqli_query($conexion, $sql);
		}
	}

	if ($enviar == "Guardar"){
		header('location:../alumno.php');
	} else {
		$nuevafecha = strtotime ( '+1 day' , strtotime ( $dia ) ) ;
		$nuevafecha = date ( 'Y-m-j' , $nuevafecha );

		$contador=0;

		while ($contador == 0) {
			$nextInsert_sql = "SELECT * FROM tarea INNER JOIN convenio ON convenio.con_id = tarea.tar_convenioid WHERE con_alumnoid = $_SESSION[id] AND tar_fecha = '$nuevafecha'";
			$next_inserts = mysqli_query($conexion, $nextInsert_sql);
			if (mysqli_num_rows($next_inserts)>0){
				$nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ) ) ;
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			} else if (date('w', strtotime($nuevafecha)) == 6 || date('w', strtotime($nuevafecha)) == 0) {
				$nuevafecha = strtotime ( '+1 day' , strtotime ( $nuevafecha ));
				$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
			} else {
				$newDate = date("j/n/Y", strtotime($nuevafecha));
				$contador++;
			}
	 }

		header("location:../insertTareasAlumno.php?dia=$newDate");

	}
