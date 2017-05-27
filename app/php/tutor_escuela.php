<?php 
session_start();
include 'restriccion/restriccion.php';
include '../../bd_con/conexion.php';

unset($_SESSION["al"]);
// echo "$_SESSION[nombre]";
 ?> 
 <!DOCTYPE html>
 <html>
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
	<title>HOURJOB</title>
 	<script src="../js/jquery-3.1.1.min.js"></script>
 	<script type="text/javascript">
 		$(document).ready(function(){
 			$('#alumno').on('keyup', function(){
	 			var data = "alumno="+$(this).val();
	 			//alert(data);
	 			$.ajax({
					type: 'POST',
					url: 'buscarAlumno.php',
					data: (data),
					success: function(resp){
						if (resp!="") {
							$('#alumnos').html(resp);
						}	
					}
				})
			});
 		});
 	</script>
 </head>
 <body>
 <div class="all">
	<header class="head-app">
		<div class="container">	
				<div class="col-sm-3 col-xs-6">
					<a href="tutor_escuela.php"><img src="../img/logo-app-hourjob.png" class="head-logo grow"></a>
				</div>
				<div class="col-sm-3 head-txt col-xs-4">
					Tutor Escuela
				</div>

				<div class="col-xs-2 menu_bar">
					<a href="#" class="bt-menu"><i class="fa fa-bars" aria-hidden="true"></i></a>
				</div>
				
				<div class="col-sm-offset-3 col-sm-3 head-opc"> 
					<nav>
						<ul>
								<!-- <li><a href="alumno.php" onclick="enviarHome();"><i class="fa fa-calendar-o fa-2x" aria-hidden="true" title="Inicio"></i></a></li>	
								
								<li><a href="perfilAlumno.php" onclick="enviarDatos();"><i class="fa fa-user fa-2x" aria-hidden="true" title="Perfil"></i></a></li> -->
								
								<li><a href="proc/logout.proc.php"><i class="fa fa-power-off fa-2x" style="color: #E74C3C" aria-hidden="true" title="Cerrar Sesión"></i></a></li>

						</ul>
					</nav>
				</div>
		</div>
	</header>

<br><br>
<div class="container">
<div class="col-sm-6">
		<div class="col-sm-12 buscar">
			<div class="col-sm-6">
				<p class='sub-fct fuente'>BUSCAR <span class='sub-fct-azul'>ALUMNO</span></p>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
			    	<span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
			    	<input class="form-control" id="alumno" type="text" name="alumno">
			  	</div> 	
			</div>
			<div class="col-sm-12">
				<div id="alumnos"></div>
			</div>	
		</div>
		<div class="col-sm-12 buscar">
			<div class="col-sm-6">
				<p class='sub-fct fuente'>Próximos alumnos en finzalizar</p>
			</div>
			<div class="col-sm-6">
				<div class="input-group">
			    	<span class="input-group-addon"><i class="fa fa-search" aria-hidden="true"></i></span>
			    	<input class="form-control" id="alumno" type="text" name="alumno">
			  	</div> 	
			</div>
			<div class="col-sm-12">
	<?php 
	$sql = "SELECT * FROM alumno INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid INNER JOIN convenio ON convenio.con_alumnoid = alumno.alu_id WHERE cic_tutescid = $_SESSION[id]";
	$alus = mysqli_query($conexion, $sql);
	while ($alu = mysqli_fetch_object($alus)) {
		$alu = $alu->con_id;
			$horas_sql = "SELECT SUM(tar_duracion) as horas_ciclo, cic_horas FROM ciclo INNER JOIN tipo_tarea ON tipo_tarea.tt_cicloid = ciclo.cic_id INNER JOIN tarea ON tarea.tar_tiptareaid = tipo_tarea.tt_id INNER JOIN alumno ON alumno.alu_cicloid = ciclo.cic_id WHERE cic_tutescid = $_SESSION[id] AND tar_convenioid = '$alu'";
			echo "$horas_sql<br>";
				$horas_ciclos = mysqli_query($conexion, $horas_sql);
				while ($horas_ciclo = mysqli_fetch_object($horas_ciclos)) {
					echo "$horas_ciclo->horas_ciclo<br>";
				}
	}

	 ?>
			</div>	
		</div>

	
</div>
<div class="col-sm-offset-6">
 <?php
 echo "<div class='col-sm-12 val-empresa'>"; 
 $validaciones_0_sql = "SELECT * FROM validacion INNER JOIN convenio ON convenio.con_id = validacion.val_convenioid INNER JOIN 	alumno ON alumno.alu_id = convenio.con_alumnoid INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE cic_tutescid = $_SESSION[id] AND val_validado = '0'";
 $validaciones_0 = mysqli_query($conexion, $validaciones_0_sql);
 $num_validaciones_0 = mysqli_num_rows($validaciones_0);

echo "<div class='col-sm-12'>";
	echo "<p class='sub-fct fuente'>VALIDACIONES <span class='sub-fct-azul'>EMPRESA</span> <span class='badge text-normal'>$num_validaciones_0</span></p>";
echo "</div>";

 	if(mysqli_num_rows($validaciones_0)>0){
 		echo "<table class='table' style='background:white'>";
			echo "<tr>";
				echo "<th>Apellidos</th>";
				echo "<th>Nombre</th>";
				echo "<th>Correo</th>";
				echo "<th>Telf</th>";
				echo "<th></th>";
			echo "</tr>";
		 while($validacion = mysqli_fetch_object($validaciones_0)){
		 	echo "<tr>";
		 		echo "<td>$validacion->alu_apellido1 $validacion->alu_apellido2</td>";
		 		echo "<td>$validacion->alu_nombre</td>";
		 		echo "<td>$validacion->alu_email</td>";
		 		echo "<td>$validacion->alu_telf</td>";
		 		echo "<td><a href='validarAlumnoEmp.php?id=$validacion->alu_id&mes=$validacion->val_mes'><i class='fa fa-check fa-lg' aria-hidden='true' title='Validar'></i</a></td>";	
		 	echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "<div class='col-sm-12'>";
		echo "<p>Sin alumnos por validar</p>";
		echo "</div>";
	}
echo "</div>";

echo "<div class='col-sm-12 val-escuela margin-top-2'>";
 $validaciones_1_sql = "SELECT * FROM validacion INNER JOIN convenio ON convenio.con_id = validacion.val_convenioid INNER JOIN 	alumno ON alumno.alu_id = convenio.con_alumnoid INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE cic_tutescid = $_SESSION[id] AND val_validado = '1'";
 $validaciones_1 = mysqli_query($conexion, $validaciones_1_sql);
 $num_validaciones_1 = mysqli_num_rows($validaciones_1);

echo "<div class='col-sm-12'>";
	echo "<p class='sub-fct fuente'>VALIDACIONES <span class='sub-fct-azul'>ESCUELA</span> <span class='badge text-normal'>$num_validaciones_1</span></p>";
echo "</div>";

 if(mysqli_num_rows($validaciones_1)>0){
 		echo "<table class='table' style='background:white'>";
			echo "<tr>";
				echo "<th>Apellidos</th>";
				echo "<th>Nombre</th>";
				echo "<th>Correo</th>";
				echo "<th>Telf</th>";
				echo "<th></th>";
			echo "</tr>";
		 while($validacion = mysqli_fetch_object($validaciones_1)){
		 	echo "<tr>";
		 		echo "<td>$validacion->alu_apellido1 $validacion->alu_apellido2</td>";
		 		echo "<td>$validacion->alu_nombre</td>";
		 		echo "<td>$validacion->alu_email</td>";
		 		echo "<td>$validacion->alu_telf</td>";
		 		echo "<td><a href='validarAlumnoEmpEsc.php?id=$validacion->alu_id&mes=$validacion->val_mes'><i class='fa fa-check fa-lg' aria-hidden='true' title='Validar'></i</a></td>";	
		 	echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "<div class='col-sm-12'>";
		echo "<p>Sin alumnos por validar</p>";
		echo "</div>";
	}
echo "</div>";

  ?>
  </div>
  </div>
  </div>
 </body>
 </html>