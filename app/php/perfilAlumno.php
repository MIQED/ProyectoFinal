<?php 
include '../../bd_con/conexion.php';
session_start();
include 'restriccion/restriccion.php';
 ?>
<nav>
	<ul>
		<li><a href="#" onclick="enviarDatos('perfilAlumno.php')">Datos personales</a></li>
		<li><a href="#" onclick="cambiarPerfil('perfilAlumnoFCT.php')">Datos FCT</a></li>
	</ul>	
</nav>
<div id="perfil">
<?php 

$id = $_SESSION['id'];


$sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE alu_id ='$id'";

$alumnos = mysqli_query($conexion, $sql);

while ($alumno = mysqli_fetch_object($alumnos)) {

	echo "<b>DNI</b>: $alumno->alu_dni<br>";
	echo "<b>Nombre</b>: $alumno->alu_nombre<br>";
	echo "<b>Apellidos</b>: $alumno->alu_apellido1 $alumno->alu_apellido2<br>";
	echo "<b>Sexo</b>: $alumno->alu_sexo<br>";
	echo "<b>Fecha de nacimiento</b>: $alumno->alu_fecha_n<br>";
	echo "<b>SS</b>: $alumno->alu_ss<br>";
	echo "<b>Telefono</b>: $alumno->alu_telf<br>";
	echo "<b>Direccion</b>: $alumno->alu_direccion<br>";
	echo "<b>Pais</b>: $alumno->alu_pais<br>";
	echo "<b>CP</b>: $alumno->alu_cp<br>";
	echo "<b>Observaciones</b>: $alumno->alu_observaciones<br>";
	echo "<b>Ciclo</b>: $alumno->cic_nombre<br>";
	echo "<b>Curso</b>: $alumno->alu_curso<br>";
	echo "<b>Email</b>: $alumno->alu_email<br>";
	
}
?>
</div>