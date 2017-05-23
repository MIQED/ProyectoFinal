<?php
session_start();
include 'restriccion/restriccion.php'; 
$dia = $_POST['dia'];
echo "<p><a href='verTareasAlumno.php?dia=$dia'>Formulario de tareas del dia $dia</a></p>";
 ?>