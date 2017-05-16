<?php 

$dia = $_POST['dia'];
$tipo = $_POST['tipo'];

if($tipo == 'insert'){
	echo "<p><a href='insertTareasAlumno.php?dia=$dia'>Formulario de tareas del dia $dia</a></p>";
} else {
	echo "<p><a href='updateTareasAlumno.php?dia=$dia'>Formulario de tareas del dia $dia</a></p>";
}

	

 ?>