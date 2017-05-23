<?php	include '../../../bd_con/conexion.php';

	session_start();

	$correo = $_POST['correo'];
	$pass = $_POST['pass'];

	$pass = crypt($pass, 'miqed');

	$sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid INNER JOIN convenio ON convenio.con_alumnoid = alumno.alu_id WHERE alu_email ='$correo' AND alu_pass='$pass'";
	$alumnos = mysqli_query($conexion, $sql);

	if (mysqli_num_rows($alumnos)>0){
		while ($alumno = mysqli_fetch_object($alumnos)) {
			$_SESSION['id'] = $alumno->alu_id;
			$_SESSION['nombre'] = $alumno->alu_nombre;
			$_SESSION['apellidos'] = $alumno->alu_apellido1." ".$alumno->alu_apellido2 ;
			$_SESSION['convenio'] = $alumno->con_id;
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
			$_SESSION['tipo'] = 'escuela';
		}
			header('location:../tutor_escuela.php');
		} else {

			$sql = "SELECT * FROM tutor_empresa WHERE tut_emp_email ='$correo' AND tut_emp_pass='$pass'";
			echo "<"; 
			$tutor_empresas = mysqli_query($conexion, $sql);
			if (mysqli_num_rows($tutor_empresas)>0){
				while ($tutor_empresa = mysqli_fetch_object($tutor_empresas)) {
					$_SESSION['id'] = $tutor_empresa->tut_emp_id;
					$_SESSION['empresa'] = $tutor_empresa->tut_emp_empresaid;
					$_SESSION['tipo'] = 'empresa';
					header('location:../tutor_empresa.php');
				}
			}else{
				echo "Te equivocaste de contraseña pinche";
			}
		}
	}
	?>