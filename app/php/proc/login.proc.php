<?php	include '../../../bd_con/conexion.php';

	session_start();

	$correo = $_POST['correo'];
	$pass = $_POST['pass'];

	$pass = crypt($pass, 'miqed');

	$sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE alu_email ='$correo' AND alu_pass='$pass'";
	$alumnos = mysqli_query($conexion, $sql);

	if (mysqli_num_rows($alumnos)>0){
		while ($alumno = mysqli_fetch_object($alumnos)) {
			$_SESSION['id'] = $alumno->alu_id;
			$_SESSION['nombre'] = $alumno->alu_nombre;
			$_SESSION['apellidos'] = $alumno->alu_apellido1." ".$alumno->alu_apellido2 ;

			$_SESSION['ciclo'] = $alumno->cic_id;
			}
		header('location:../alumno.php');
	} else {
		
		$sql = "SELECT * FROM tutor_escuela WHERE tut_esc_email ='$correo' AND tut_esc_pass='$pass'";
		$tutor_escuelas = mysqli_query($conexion, $sql);
		if (mysqli_num_rows($tutor_escuelas)>0){
		while ($tutor_escuela = mysqli_fetch_object($tutor_escuelas)) {
			$_SESSION['id'] = $tutor_escuela->tut_esc_id;
			$_SESSION['nombre'] = $tutor_escuela->tut_esc_nombre;
			$_SESSION['apellidos'] = $tutor_escuela->tut_esc_apellido1." ".$tutor_escuela->tut_esc_apellido2 ;
		}
		header('location:../tutor_escuela.php');
	}
	//incluir login empresa
	echo "Error";
	}
	?>