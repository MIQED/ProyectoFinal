<?php 
	session_start();
	include '../restriccion/restriccion.proc.php';
	session_destroy();

	header('location:../login.php'); 
 ?>