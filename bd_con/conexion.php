<?php
	$conexion = mysqli_connect('localhost', 'root', '', 'bd_miqed');
	$acentos = mysqli_query($conexion, "SET NAMES 'utf8'");
	
	if (!$conexion) {
		echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
		echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
		echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
		exit;
	}else{
		echo "hola";
	}
?>