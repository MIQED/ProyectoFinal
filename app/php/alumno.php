<?php
	session_start();
	include '../../bd_con/conexion.php';
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" type="text/css" href="../css/calendar.css">
	<title>Ejemplo de un simple calendario en PHP</title>
	<meta charset="utf-8">
	<script type="text/javascript">
		function objetoAjax(){
					var xmlhttp=false;
					try {
						xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
					} catch (e) {
				 
						try {
							xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
						} catch (E) {
							xmlhttp = false;
						}
					}
				 
					if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
					  xmlhttp = new XMLHttpRequest();
					}
					return xmlhttp;
				}

				function enviarDatos(){
			
				  var ajax=objetoAjax();
				var url = 'perfilAlumno.php'; 
				  ajax.open("POST", url, true);
				  ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('calendar_wrap').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send();
				}

				function cambiarPerfil(url){
			
				  var ajax=objetoAjax();
				 
				  ajax.open("POST", url, true);
				  ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('perfil').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send();
				}
				
			function enviarHome(){
			
				var ajax=objetoAjax();
				var url = 'calendarioAlumno.php';
				var currentTime = new Date();
				var showmonth = currentTime.getMonth()+1;
				var showyear = currentTime.getFullYear();
				 
				ajax.open("POST", url, true);
				ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				  ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('calendar_wrap').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send("showmonth="+showmonth+"&showyear="+showyear);
				}


				function prev_month(showmonth, showyear){
					var prevmonth = showmonth - 1;
					if (prevmonth<1){
						prevmonth = 12;
						showyear = showyear-1;
					}
					showmonth = prevmonth;

					var ajax=objetoAjax();
					var url = 'calendarioAlumno.php';
					ajax.open("POST", url, true);
					ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					 ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('calendar_wrap').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send("showmonth="+showmonth+"&showyear="+showyear);

				}

				function next_month(showmonth, showyear){
					var nextmonth = showmonth + 1;
					if (nextmonth>12){
						nextmonth = 1;
						showyear = showyear+1;
					}
					showmonth = nextmonth;

					var ajax=objetoAjax();
					var url = 'calendarioAlumno.php';
					ajax.open("POST", url, true);
					ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					 ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('calendar_wrap').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send("showmonth="+showmonth+"&showyear="+showyear);

				}

				function cambiarPerfil(url){
			
				  var ajax=objetoAjax();
				  ajax.open("POST", url, true);
				  ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('perfil').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send();
				}
				window.onload = enviarHome();

				function mostrarDias(dia, tipo){
					var ajax=objetoAjax();
					var url = 'tareasAlumno.php';
					ajax.open("POST", url, true);
					ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					 ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('tareasAlumno').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send("dia="+dia+"&tipo="+tipo);
				}

	</script>
</head>
<body>
<nav>
	<ul>
		<li><a href="#" onclick="enviarHome();">Home</a></li>
		<li><a href="#" onclick="enviarDatos();">Mi perfil</a></li>
	</ul>
</nav>
<div><a href="proc/logout.proc.php">Cerrar sessión</a></div>
<div id="calendar_wrap"></div>
</body>
</html>
