<?php
//Generador de PDF
require('/FPDF/fpdf.php');
session_start();
	include 'restriccion/restriccion.php';
	include '../../bd_con/conexion.php';


/*-----------------------------*/

$mes = $_GET['mes'];

		$ciclo_sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE alu_id = $_SESSION[al]";
			$ciclos = mysqli_query($conexion, $ciclo_sql);
			while ($ciclo = mysqli_fetch_object($ciclos)) {
				$cicloid = $ciclo->cic_id;
			 } 

		$convenio_sql = "SELECT * FROM convenio WHERE con_alumnoid = $_SESSION[al]";
		$convenios = mysqli_query($conexion, $convenio_sql);
		while ($convenio = mysqli_fetch_object($convenios)) {
			$convenioid = $convenio->con_id;
		}

 $num_tareas_sql = "SELECT * FROM tipo_tarea INNER JOIN tipo_h_tarea ON tipo_h_tarea.tip_tar_id = tipo_tarea.tt_tiphtarid WHERE tt_cicloid = $cicloid";
	$num_tareas = mysqli_query($conexion, $num_tareas_sql);
	$num_tareas = mysqli_num_rows($num_tareas);
 
$meses = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio',
               'Agosto','Septiembre','Octubre','Noviembre','Diciembre');

if (strstr($mes, '0')){
		$mes_0 = substr($mes, -1);
	} else {
		$mes_0 = $mes;
	}
		$mes_0 = $mes_0-1;

$mes_d = $meses[$mes_0];


 		// $sql = "SELECT * FROM validacion WHERE val_mes='$mes' AND val_convenioid='$convenioid'";
 		// $results = mysqli_query($conexion, $sql);
 		// while ($result = mysqli_fetch_object($results)) {
	 	// 	echo "<b>Observaciones empresa</b><br>";
	 	// 	if ($result->val_observacionEmp != ""){
	 	// 		echo "<p>$result->val_observacionEmp</p>";
	 	// 	} else {
	 	// 		echo "<p>Sin observaciones</p>";
	 	// 	}
	 	// 	echo "<br>";

	 	// 	echo "<b>Observaciones esuela</b><br>";
	 	// 	if ($result->val_observacionEsc != ""){
	 	// 		echo "<p>$result->val_observacionEsc</p>";
	 	// 	} else {
	 	// 		echo "<p>Sin observaciones</p>";
	 	// 	}
 		// }


/*-----------------------------*/
	$pdf=new FPDF();
	$pdf->AddPage(); 
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(50, 40, "");
	$pdf->Cell(45,40,utf8_decode("Validación FCT: $mes_d"),0,0);	
	$pdf->Ln(30);
	//Alumne
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(20,10,utf8_decode("Datos Alumno"),0, 1);
	$sql = "SELECT * FROM alumno WHERE alu_id='$_SESSION[al]'";
	$alumnos=mysqli_query($conexion, $sql);
	while ($alumno = mysqli_fetch_object($alumnos)) {
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Nombre:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$alumno->alu_nombre $alumno->alu_apellido1 $alumno->alu_apellido2"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(40,7,utf8_decode("DNI:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(40,7,utf8_decode("$alumno->alu_dni"), 0, 1);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Correo:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$alumno->alu_email"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(40,7,utf8_decode("Fecha de nacimiento:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(40,7,utf8_decode("$alumno->alu_fecha_n"), 0, 1);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Domicilio:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$alumno->alu_direccion"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(40,7,utf8_decode("CP:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(40,7,utf8_decode("$alumno->alu_cp"));
		
	$pdf->Ln(15);
	//Escuela
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(20,10,utf8_decode("Datos Escuela"),0, 1);
	$sql = "SELECT * FROM tutor_escuela INNER JOIN ciclo ON ciclo.cic_tutescid = tutor_escuela.tut_esc_id INNER JOIN escuela ON escuela.esc_id = tutor_escuela.tut_esc_escuelaid WHERE tut_esc_id='$_SESSION[id]'";
	$escuelas=mysqli_query($conexion, $sql);
	while ($escuela = mysqli_fetch_object($escuelas)) {
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Escuela:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$escuela->esc_nombre"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Teléfono:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(40,7,utf8_decode("$escuela->esc_telf"), 0, 1);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Direccion:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$escuela->esc_direccion"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("CP:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(40,7,utf8_decode("$escuela->esc_cp 	"), 0, 1);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Tutor:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$escuela->tut_esc_nombre $escuela->tut_esc_apellido1 $escuela->tut_esc_apellido2"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Correo:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$escuela->tut_esc_email"), 0, 0);
		
	$pdf->Ln(15);

	//Empresa
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(20,10,utf8_decode("Datos Empresa"),0, 1);
	$sql = "SELECT * FROM convenio INNER JOIN tutor_empresa ON tutor_empresa.tut_emp_id = convenio.con_empresaid INNER JOIN empresa ON empresa.emp_id = tutor_empresa.tut_emp_empresaid WHERE con_alumnoid = '$_SESSION[al]'";
	$empresas=mysqli_query($conexion, $sql);
	while ($empresa = mysqli_fetch_object($empresas)) {
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Empresa:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$empresa->emp_nom"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Teléfono:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(40,7,utf8_decode("$empresa->emp_telf"), 0, 1);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Direccion:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$empresa->emp_direccion"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("CP:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(40,7,utf8_decode("$empresa->emp_cp"), 0, 1);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Tutor:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$empresa->tut_emp_nombre $empresa->tut_emp_apellido1 $empresa->tut_emp_apellido2"), 0, 0);
		$pdf->SetFont('Arial','B',9);
		$pdf->Cell(20,7,utf8_decode("Correo:"), 0, 0);
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(60,7,utf8_decode("$empresa->tut_emp_email"), 0, 0);
		

	$pdf->Ln(15);
	$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $cicloid";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {	
	$pdf->SetFont('Arial','B',9);
	$pdf->MultiCell(0,10,utf8_decode("$tipo_tar->tip_tar_descripcion"));
	$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	$tareas = mysqli_query($conexion, $tarea_sql); 				
	while ($tarea = mysqli_fetch_object($tareas)) {
	 	$tar_sql = "SELECT * FROM validar_tarea INNER JOIN validacion ON validacion.val_id = validar_tarea.vt_validacionid WHERE val_convenioid='$convenioid' AND vt_tipotareaid = '$tarea->tt_id' AND val_mes='$mes'";
		$tars = mysqli_query($conexion, $tar_sql);

	 while($tar = mysqli_fetch_object($tars)){
	// $pdf->Ln(7);
	  $pdf->SetFont('Arial','',9);
	// $pdf->Cell(10, 10, "");
	  $pdf->MultiCell(0, 10, utf8_decode($tarea->tt_descripcion), 0, 1);
	  $pdf->SetFont('Arial','I',9	);
	  $pdf->Cell(54, 10, utf8_decode($tar->vt_notaEmpresa));
	  $pdf->Ln(15);
	 			}	 	
			}

		$pdf->Ln(14);
 		}
 		$sql = "SELECT * FROM validacion WHERE val_mes='$mes' AND val_convenioid='$convenioid'";
 		$results = mysqli_query($conexion, $sql);
 		while ($result = mysqli_fetch_object($results)) {
 			$pdf->SetFont('Arial','B',9);
	 		$pdf->Cell(54, 10, utf8_decode("Observaciones empresa"),0, 1);
	 		 $pdf->SetFont('Arial','',9);
	 		if ($result->val_observacionEmp != ""){
	 			$pdf->MultiCell(54, 10, utf8_decode("$result->val_observacionEmp"), 0, 1);
	 		} else {
	 			$pdf->Cell(54, 10, utf8_decode("Sin observaciones"), 0, 1);
	 		}
	 		 $pdf->Ln(15);

	 		$pdf->SetFont('Arial','B',9);
	 		$pdf->Cell(54, 10, utf8_decode("Observaciones escuela"), 0, 1);
	 		$pdf->SetFont('Arial','',9);
	 		if ($result->val_observacionEsc != ""){
	 		$pdf->MultiCell(54, 10, utf8_decode("$result->val_observacionEsc"), 0, 1);
	 		} else {
	 		$pdf->Cell(54, 10, utf8_decode("Sin observaciones"), 0, 1);
	 		}
 		}
 		$pdf->Cell(190, 55, "", 0, 1);
 		$pdf->Cell(63, 10 ,"Tutor Escuela", 0, 0, "C");
 		$pdf->Cell(63, 10 ,"Tutor Empresa", 0, 0, "C");
 		$pdf->Cell(63, 10 ,"Alumno", 0, 1, "C");
 		$pdf->SetFont('Arial','B',9);
 		$pdf->Cell(63, 10 ,"$escuela->tut_esc_nombre $escuela->tut_esc_apellido1 $escuela->tut_esc_apellido2", 0, 0, "C");
 		$pdf->Cell(63, 10 ,"$empresa->tut_emp_nombre $empresa->tut_emp_apellido1 $empresa->tut_emp_apellido2", 0, 0, "C");
 		$pdf->Cell(63, 10 ,"$alumno->alu_nombre $alumno->alu_apellido1 $alumno->alu_apellido2", 0, 1, "C");
 	}//Alumno
 	}//Escuela
	}//Empresa
	//Finalizar el PDF
	$pdf->Output();
?>	