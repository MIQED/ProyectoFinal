<?php
session_start();
include 'restriccion/restriccion.php'; 
$dia = $_POST['dia'];
echo "<p class='bg-info'><a href='verTareasAlumno.php?dia=$dia'>Formulario de tareas del día $dia</a></p>";
 ?>