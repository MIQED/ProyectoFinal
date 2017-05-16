<?php 


include '../../../bd_con/conexion.php';

session_start(); 

	$totalHoras = $_POST['totalHoras']; 

for ($i=0; $i <= $totalHoras; $i++) { 

		if (isset($_POST[''.$i.''])){
			$horasTarea = $_POST[''.$i.''];
			echo "$i----$horasTarea<br>";

			//Realizar insert en la base de datos

		}
	}

	header('location:../alumno.php');

?>