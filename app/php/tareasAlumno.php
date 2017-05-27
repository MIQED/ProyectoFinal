<?php 
session_start();
include 'restriccion/restriccion.php';

$dia = $_POST['dia'];
$tipo = $_POST['tipo'];

if($tipo == 'insert'){
	echo "<p class='bg-info'><a href='insertTareasAlumno.php?dia=$dia'>Formulario de tareas del día $dia</a></p>";
} else {
	echo "<p class='bg-info'><a href='updateTareasAlumno.php?dia=$dia'>Ver o modificar tareas hechas del día $dia</a></p>";
}

	

 ?>