<?php 
include '../../bd_con/conexion.php';
session_start();
include 'restriccion/restriccion.php';
 ?>
 <div class="perfil-opc center">
	 	<div class="col-sm-offset-4 col-sm-2">
	 		<a type="button" class="btn btn-default" onclick="enviarDatos('perfilAlumno.php')"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;Mis Datos</a>
	 	</div>
	 	<div class="col-sm-2">
	 		<a type="button" class="btn btn-default" onclick="cambiarPerfil('perfilAlumnoFCT.php')"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp;&nbsp;Mi FCT</a>
	 	</div>
 </div>
<br><br>
<div id="perfil">
		<div class="col-sm-offset-4 col-sm-4 post-it">
				<div class="col-sm-offset-3 col-sm-2 center">
					&nbsp;&nbsp;<img src="../img/chincheta.png" width="70">
				</div>
			
<div class="row">
<div class="col-sm-12">	
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
	echo "<b>Ciclo</b>: $alumno->cic_nombre<br>";
	echo "<b>Curso</b>: $alumno->alu_curso<br>";
	echo "<b>Email</b>: $alumno->alu_email<br>";
	echo "<b>Teléfono</b>: $alumno->alu_telf<br>";
	echo "<b>Nº S.S.</b>: $alumno->alu_ss<br>";
	echo "<b>Dirección</b>: $alumno->alu_direccion<br>";
	echo "<b>C.P.</b>: $alumno->alu_cp<br>";
	echo "<b>País</b>: $alumno->alu_pais<br>";
	echo "<b>Observaciones</b>: $alumno->alu_observaciones<br>";	
}
?>
</div>
</div>
		</div>
</div>