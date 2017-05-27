<?php 	
include '../../bd_con/conexion.php';
session_start();
include 'restriccion/restriccion.php';
$id = $_SESSION['id'];

$horas_sql = "SELECT SUM(tar_duracion) as horas_ciclo, cic_horas FROM ciclo INNER JOIN tipo_tarea ON tipo_tarea.tt_cicloid = ciclo.cic_id INNER JOIN tarea ON tarea.tar_tiptareaid = tipo_tarea.tt_id WHERE cic_id = $_SESSION[ciclo] AND tar_convenioid = $_SESSION[convenio] ";
$horas_ciclos = mysqli_query($conexion, $horas_sql);
while ($horas_ciclo = mysqli_fetch_object($horas_ciclos)) {
if ($horas_ciclo->horas_ciclo == NULL) {
	$horas_ciclo->horas_ciclo = 0;
}
$cien = $horas_ciclo->cic_horas;
$lax = $horas_ciclo->horas_ciclo;
$porcentaje = ($lax*100)/$cien;

echo "<div class='progress'>";
    echo "<div class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar' aria-valuenow= '$lax' aria-valuemin='0' aria-valuemax='$cien' style='width:$porcentaje%'><span style='font-size:15px'>$lax h</span>";
    echo "</div>";
echo "</div>";

echo "<div class='center horas-fct'>";
echo "<div class='col-sm-4'>";
	echo "<p>Horas realizadas: <span style='color: green'> $horas_ciclo->horas_ciclo</span></p>";
echo "</div>";
echo "<div class='col-sm-4'>";
	$horasRestantes = $horas_ciclo->cic_horas - $horas_ciclo->horas_ciclo;
	echo "<p>Horas restantes: $horasRestantes</p>";
echo "</div>";
echo "<div class='col-sm-4'>";
	echo "<p>Horas totales: <span style='color: #0033ff'>$horas_ciclo->cic_horas</span></p>";
echo "</div>";
echo "</div>";
}

echo "<div class='col-sm-12'>";
echo "<p class='sub-fct'>DATOS <span class='sub-fct-azul'>ESCUELA</span></p>";
echo "<div class='text-normal'>";
	echo "<div class='col-sm-6'>";
	$escuelas_sql = "SELECT * FROM tutor_escuela INNER JOIN ciclo on ciclo.cic_tutescid = tutor_escuela.tut_esc_id INNER JOIN escuela ON escuela.esc_id = tutor_escuela.tut_esc_escuelaid WHERE cic_id = $_SESSION[ciclo] ";
	$escuelas = mysqli_query($conexion, $escuelas_sql);
	while ($escuela = mysqli_fetch_object($escuelas)){
		echo "<b>Nombre Tutor</b>: $escuela->tut_esc_nombre<br>";
		echo "<b>Apellidos Tutor</b>: $escuela->tut_esc_apellido1 $escuela->tut_esc_apellido2<br>";
		echo "<b>Correo Tutor</b>: $escuela->tut_esc_email<br>";
		echo "<b>Telf Tutor</b>: $escuela->tut_esc_telf<br>";
	echo "</div>";
	echo "<div class='col-sm-6'>";
		echo "<b>Nombre</b>: $escuela->esc_nombre<br>";
		echo "<b>Direccion</b>: $escuela->esc_direccion<br>";
		echo "<b>CP</b>: $escuela->esc_cp<br>";		
		echo "<b>Teléfono</b>: $escuela->esc_telf<br>";
	echo "</div>";
	}
echo "</div>";
echo "</div>";
echo "<br><br><br><br><br><br><br><br><br><br>";
echo "<div class='col-sm-12'>";
	echo "<p class='sub-fct'>DATOS <span class='sub-fct-azul'>EMPRESA</span></p>";
echo "<div class='text-normal'>";
	echo "<div class='col-sm-6'>";
	$empresa_sql = "SELECT * FROM convenio INNER JOIN empresa ON empresa.emp_id = convenio.con_empresaid INNER JOIN tutor_empresa ON tutor_empresa.tut_emp_empresaid = empresa.emp_id WHERE con_alumnoid = $id";
	// echo "$empresa_sql";
	$empresas = mysqli_query($conexion, $empresa_sql);
	while ($empresa = mysqli_fetch_object($empresas)) {
		echo "<b>Nombre Tutor</b>: $empresa->tut_emp_nombre<br>";
		echo "<b>Apellidos Tutor</b>: $empresa->tut_emp_apellido1 $empresa->tut_emp_apellido2<br>";
		echo "<b>Correo Tutor</b>: $empresa->tut_emp_email<br>";
		echo "<b>Telf Tutor</b>: $empresa->tut_emp_telf<br>";
	echo "</div>";
	echo "<div class='col-sm-6'>";
		echo "<b>Nombre</b>: $empresa->emp_nom<br>";
		echo "<b>Direccion</b>: $empresa->emp_direccion<br>";
		echo "<b>CP</b>: $empresa->emp_cp<br>";
		echo "<b>Teléfono</b>: $empresa->emp_telf<br>";
	echo "</div>";	
	}
echo "</div>";
echo "</div>";

echo "<br><br><br><br><br><br><br><br>";
echo "<div class='col-sm-12'>";
	echo "<p class='sub-fct'>REGISTRO DE <span class='sub-fct-azul'>HORAS</span></p>";
echo "<div class='text-normal'>";
	echo "<table class='table'>";
		$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $_SESSION[ciclo]";
 		 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);
	 				echo "<tr class='info'>";
	 				echo "<td><b style='font-size:15px'>$tipo_tar->tip_tar_descripcion</b></td>";
	 				echo "</tr>";

	 			while ($tarea = mysqli_fetch_object($tareas)) {


	 				$tar_sql = "SELECT SUM(tar_duracion) as horas FROM tarea INNER JOIN convenio ON tarea.tar_convenioid = convenio.con_id WHERE con_alumnoid='$id' AND tar_tiptareaid = '$tarea->tt_id'";
	 				$tars = mysqli_query($conexion, $tar_sql);
	 				echo "<tr>";
	 				while($tar = mysqli_fetch_object($tars)){
	 					if ($tar->horas != null){	
	 						echo "<td><p>$tarea->tt_descripcion</p></td><td><p><b>$tar->horas</b></p></td>";
	 					} else {
	 						echo "<td><p>$tarea->tt_descripcion</p></td><td><p style='color:red'><b>0</b></p></td>";
	 					}
	 				}
	 				echo "</tr>";
	 			}

 		}
 		echo "</table>";

 		echo "<br><br>";
echo "</div>";
echo "</div>";



//Horas realizadas + horas totales + horas restantes +  ver horas realizadas en cada tarea
?>