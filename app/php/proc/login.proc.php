<?php	include '../../../bd_con/conexion.php';

	session_start();

	$correo = $_POST['correo'];
	$pass = $_POST['pass'];

	$pass = crypt($pass, 'miqed');

	$sql = "SELECT * FROM alumno WHERE alu_email ='$correo' AND alu_pass='$pass'";

	$alumnos = mysqli_query($conexion, $sql);

	if (mysqli_num_rows($alumnos)>0){
		while ($alumno = mysqli_fetch_object($alumnos)) {
			$_SESSION['id'] = $alumno->alu_id;
			$_SESSION['nombre'] = $alumno->alu_nombre;
			$_SESSION['apellidos'] = $alumno->alu_apellido1." ".$alumno->alu_apellido2 ;
		}
		header('location:../alumno.php');
	} else {
		
		//Incluir login profesor y empresa

	}
	?>