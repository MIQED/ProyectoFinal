<!DOCTYPE html>
<html>
<head>
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet/less" type="text/css" href="less/hourjob.less">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
  	<link rel="shortcut icon" type="image/x-icon" href="img/favicon_app.ico">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  	<!-- menu -->
  	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/menu.js"></script>
	<!-- fin menu -->
  	
	<script type="text/javascript" src="less/less.js"></script>
	<title>HOURJOB</title>
</head>
<body>
	<div class="all">
		<header>
		<div class="logo">
		<div class="container">
				<div class="col-sm-12 col-xs-8 grow">
					<a href="index.php"><img src="img/logo-app-hourjob.png" width="200" class="img-logo"></a>
				</div>
				<div class="col-xs-3 menu_bar">
					<a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</div>
				</div>
		</div>
			<div class="container">	
					<nav>
						<ul>
							<div class="col-sm-offset-2 col-sm-8">
								<li><a href="#quees">¿Qué es?</a></li>	
							
								<li><a href="#objetivos">Objetivos</a></li>

								<li><a href="#trabajo">Trabajo</a></li>
							
								<li><a href="#contacto">Contáctanos</a></li>
							</div>	
						</ul>
					</nav>
			</div>
		
	</header>

	<div class="principal" style="background: url(img/fondo.jpg) no-repeat;">
	<!-- <img src="img/startup-photos.jpg" width="1500"> -->
			<div class="container">
				<div class="col-sm-6 texto-fondo">
					<p class="fondo-fondo">INVIERTE TU <SPAN class="azul">TIEMPO</SPAN> PARA EL <SPAN class="azul">FUTURO</SPAN></p>
				</div>
					<div class="col-sm-offset-2 col-sm-4 login">
						<img src="img/logo-app.png" class="logo-form">
						<div class="form">
							<?php include_once 'php/login.php'; ?>	
						</div>
					</div>
				
			</div>
			
	</div>

	<a name="quees"></a>
	<section class="que-es">
		<div class="container">
			<div class="row">
				<div class="col-sm-offset-4 col-sm-4 info-que-es">
					<img src="img/logo-app-hourjob.png" width="200" class="info-que-es-logo"><br><p>
HOURJOB es una aplicación desarrollada por el equipo MIQED. Toma las bases del ya conocido: Banco integrado de datos (qBID), y mejora la experiencia del usuario, con una nueva interfaz y mejor usabilidad.
					</p>
				</div>
			</div>

			<div class="row center padd">
				<div class="col-sm-4 padd-bot">
					<i class="fa fa-user fa-4x" aria-hidden="true"></i>
					<h3><b class="tiny-azul">OUR</b> Alumno</h3>
					<p>
						Te ofrecemos la forma más rápida y dinámica de hacer el seguimiento a las horas trabajadas en tus FCT. HOURJOB está montado basandose en las opiniones de los alumnos.
					</p>
				</div>
				<div class="col-sm-4 padd-bot">
					<i class="fa fa-book fa-4x" aria-hidden="true"></i>
					<h3><b class="tiny-azul">OUR</b> Tutor de Escuela</h3>
					<p>
						Sabemos que eres el que más trabajo tiene como tutor de escuela, en HOURJOB hemos intentado simplificarte el trabajo lo máximo posible. Entra y descubre lo que tenemos para tí.
					</p>
				</div>
				<div class="col-sm-4 padd-bot">
					<i class="fa fa-briefcase fa-4x" aria-hidden="true"></i>
					<h3><b class="tiny-azul">OUR</b> Tutor de Empresa</h3>
					<p>
						El perfil de tutor de empresa ha sido desarrollado para cubrir las tareas básicas del usuario. Ponte en contacto con los alumnos y el tutor de escuela de la forma más fácil posible.
					</p>
				</div>
			</div>
					
		</div>
	</section>

	<a name="objetivos"></a>
	<section class="objetivos">
		<div class="container">
			<div class="col-sm-12 texto-obj">
					<p class="fondo-fondo">Nuestro <SPAN class="azul-obj">objetivo</SPAN></p>
			</div>
			<img src="img/obj1.png" class="img-objetivos" class="img-objetivos-txt" width="300">
			<img src="img/obj2.png" class="img-objetivos" class="img-objetivos-txt" width="300">
			<img src="img/team-600x400px.png" width="320" class="img-objetivos">
		</div>
	</section>

	<a name="trabajo"></a>
	<section class="exp">
		<div class="container">
			<div class="col-sm-12 texto-obj">
				<p class="fondo-fondo">Nuestro <SPAN class="azul-obj">trabajo</SPAN></p>
			</div>
			
			<div class="col-sm-8">
				<p>
				<i class="fa fa-check-square-o azul-obj" aria-hidden="true"></i> HOURJOB está desarrollado por el equipo de <img src="img/logo-empresa.png" width="50"> buscando que nuestros usuarios disfruten usando la aplicación.
				</p>
				<br>
				<p>
				<i class="fa fa-check-square-o azul-obj" aria-hidden="true"></i> Nuestro equipo ha realizado una serie de encuestas a lolargo del desarrollo de la aplicación, para tomar en cuenta la opinión de los usuarios que usan esta aplicación a lo largo de sus FCT.
				</p>
				<br>
				<p>
				<i class="fa fa-check-square-o azul-obj" aria-hidden="true"></i> Al igual que con los alumnos, hemos tomado nota de las necesidades del tutor de escuela, facilitando su trabajo. 
				</p>
				<br>
				<p>
				<i class="fa fa-check-square-o azul-obj" aria-hidden="true"></i> Hemos analizado la competencia y mejorado muchos de los aspectos en los que los usuarios tenían problemas con esta herramienta. 
				</p>
				<br>
				<p>
				<i class="fa fa-check-square-o azul-obj" aria-hidden="true"></i> El producto final ha sido testeado por muchos de los usuarios que brindaron su opinión acerca de la herramienta ya establecida (qBID) y la respuesta ha sido satisfactoria.
				</p>
			</div>
			<div class="col-sm-4">
				<img src="img/work.png" width="330" class="img-trabajo">
			</div>
		</div>
	</section>

	<a name="contacto"></a>
	<section class="miqed">	
		<div class="container">
			<div class="col-sm-12">
				<div class="texto-miqed">
					<p>Esta <span class="azul-obj">aplicación web</span><br>
					ha sido desarrollada por</p>
					<a href="http://miqed.esy.es/" target="blank"><img src="img/logo-empresa.png" width="200" class="logo-miqed grow"></a>
				</div>
			</div>		
		</div>
	</section>

	<footer>
		&copy; Copyright 2017 <img src="img/logo-app-hourjob.png" width="100"> | Todos los derechos reservados. Página desarrollada por <img src="img/logo-empresa.png" width="50">
	</footer>
</div>
</body>
</html>