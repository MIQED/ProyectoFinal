<!DOCTYPE html>
<html>
<head>
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet/less" type="text/css" href="less/miqed.less">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  	<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">

  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  	<!-- menu -->
  	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="js/menu.js"></script>
	<!-- fin menu -->
  	
	<script type="text/javascript" src="less/less.js"></script>
	<title>MIQED</title>
</head>
<body>
<div class="all">
	<header>
		<div class="container">

			<div class="col-sm-6 logo">
				<a href="#"><img src="img/logo-empresa.png" width="200"></a>
			</div>
			<br>
			<div class="menu_bar">
				<a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
			</div>

				<nav>
					<ul>
						<div class="col-sm-4">
							<li><a href="#nosotros"><span class="icon-house"></span>Nosotros</a></li>	
						</div>
						<div class="col-sm-4">
							<li><a href="#trabajo"><span class="icon-suitcase"></span>Trabajos</a></li>
						</div>
						<div class="col-sm-4">
							<li><a href="#contacto"><span class="icon-rocket"></span>Contacto</a></li>
						</div>	
					</ul>
				</nav>
			
		</div>
	</header>

	<!-- <div class="app">
		<div class="container">
			<div class="col-sm-8">
				<img src="img/bg-app.jpg" class="bg-app">
			</div>
				<div class="col-sm-4 form-app">
					<p class="login-text">Acceder a ...</p>
					<br><br>
					<img src="img/logo-app.png" class="logoapp">
				
					<form>
						<input type="text" class="form-control input-app" placeholder="Correo">
						<input type="password" class="form-control input-app" placeholder="Contraseña">
					</form>
				</div>
			</div>
				
		</div>	 -->
	
	
	<div class="slider">
		<div class="container">

		  <div id="myCarousel" class="carousel slide carousel" data-ride="carousel" style="width: 100%;">
		    <ol class="carousel-indicators">
		      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		      <li data-target="#myCarousel" data-slide-to="1"></li>
		      <li data-target="#myCarousel" data-slide-to="2"></li>
		    </ol>

		    <div class="carousel-inner">
		      <div class="item active">
		        <img src="img/la.jpg" alt="Los Angeles" class="img-slider">
		      </div>

		      <div class="item">
		        <img src="img/chicago.jpg" alt="Chicago" class="img-slider">
		      </div>
		    
		      <div class="item">
		        <img src="img/ny.jpg" alt="New york" class="img-slider">
		      </div>
		    </div>

		    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
		      <span class="glyphicon glyphicon-chevron-left"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel" data-slide="next">
		      <span class="glyphicon glyphicon-chevron-right"></span>
		      <span class="sr-only">Next</span>
		    </a>
		</div>
	</div>
	</div>
	

	<a name="nosotros"></a>
	<div class="empresa">
		<div class="container">
			<div class="col-sm-12 titulo">
				<p>NOSOTROS</p>
			</div>
			<div class="col-sm-offset-3 col-sm-6 empresa-texto">
				<p>
					<i>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse eu sollicitudin dolor. Integer lorem justo, hendrerit eu consequat id, laoreet eu felis. Nulla vitae luctus diam. Sed in velit malesuada, luctus turpis eget, mattis odio. Sed ac libero iaculis, semper ligula vel, fringilla lorem. Suspendisse bibendum suscipit varius. Aenean porta.</i>
				</p>	
				<img src="img/logo-empresa.png" width="150">
			</div>
		</div>
	</div>

	<a name="trabajo"></a>
	<div class="trabajos">
		<div class="container">
			<div class="col-sm-12 titulo">
				TRABAJOS
			</div>
			<div class="col-sm-offset-3 col-sm-6 info-tra">
				<i>A lo largo de todo el curso de DAW2 nuestro equipo se ha visto involucrado en unos cuantos proyectos, obteniendo buenos resultados, fruto del buen trabajo en equipo, compañerismo y la cohesión.</i>
			</div>

			<div class="content-tra">
					<div class="col-sm-offset-2 col-sm-2 thumbnail  grow">
					    
					      <img src="img/logo-app.jpg" class="img-tra">
					    
					    <div class="caption">
					        <p>App ¿?</p>
					    </div>
					</div>
				
				
					<div class="col-sm-offset-1 col-sm-2 thumbnail grow">
					    
					      <img src="img/3.jpg" class="img-tra">

					    <div class="caption">
					        <p>SocTree</p>
					    </div>
					</div>
				
					<div class="col-sm-offset-1 col-sm-2 thumbnail grow">
					   
					      <img src="img/header.jpg" class="img-tra">

					    <div class="caption">
					        <p>MyContacts</p>
					    </div>
					</div>
			</div>
		</div>
	</div>

	<a name="contacto"></a>
	<div class="contacto">
		<div class="container">
			<div class="col-sm-12 titulo">
				<p>CONTACTO</p>
			</div>
			<div class="info-contacto">
				<div class="col-sm-offset-4 col-sm-1">
					<img src="img/logo-empresa.png" width="80">
				</div>
				<div class="col-sm-3">
					<p class="mail">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-envelope-o" aria-hidden="true"></i>
						miqed.info@gmail.com
					</p>
				</div>
			</div>

			<div class="row">
				<div class="social-media">
					<div class="col-sm-12">
						<a href=""><i class="fa fa-facebook" aria-hidden="true"></i></a>
						&nbsp;&nbsp;&nbsp;&nbsp;
						<a href=""><i class="fa fa-twitter" aria-hidden="true"></i></a>
					&nbsp;&nbsp;&nbsp;&nbsp;
						<a href=""><i class="fa fa-instagram" aria-hidden="true"></i></a>
					&nbsp;&nbsp;&nbsp;&nbsp;
						<a href=""><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer>
		&copy; Copyright 2017 <img src="img/logo-empresa.png" width="50"> | Todos los derechos reservados
	</footer>
</div>
</body>
</html>