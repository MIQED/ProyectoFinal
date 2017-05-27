<?php
	session_start();
	include 'restriccion/restriccion.php';
	include '../../bd_con/conexion.php';
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<link rel="stylesheet" type="text/css" href="../css/calendar.css">
  	<link rel="shortcut icon" type="image/x-icon" href="../img/favicon_app.ico">
  	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet/less" type="text/css" href="../less/alumno.less">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../less/less.js"></script>

	<!-- menu -->
  	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="../js/menu.js"></script>
	<!-- fin menu -->

	<title>HOURJOB</title>
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
<div class="all">
	<header class="head-app">
		<div class="container">	
				<div class="col-sm-3 col-xs-6">
					<a href="alumno.php"><img src="../img/logo-app-hourjob.png" class="head-logo grow"></a>
				</div>
				<div class="col-sm-3 head-txt col-xs-4">
					Alumno
				</div>

				<div class="col-xs-2 menu_bar">
					<a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</div>
				
				<div class="col-sm-offset-3 col-sm-3 head-opc"> 
					<nav>
						<ul>
								<li><a href="#" onclick="enviarHome();"><i class="fa fa-calendar-o fa-2x" aria-hidden="true" title="Inicio"></i></a></li>	
								
								<li><a href="#" onclick="enviarDatos();"><i class="fa fa-user fa-2x" aria-hidden="true" title="Perfil"></i></a></li>
								
								<li><a href="proc/logout.proc.php"><i class="fa fa-power-off fa-2x" style="color: #E74C3C" aria-hidden="true" title="Cerrar Sesión"></i></a></li>

						</ul>
					</nav>
				</div>
		</div>
	</header>
	<div class="container">
		<div id="calendar_wrap" class="calendario"></div>
	</div>
</div>	 
</body>
</html>
