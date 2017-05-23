<?php 

	include '../../bd_con/conexion.php';
	session_start();
	include 'restriccion/restriccion.php';
 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 <script src="../js/jquery-3.1.1.min.js"></script>
 	<script type="text/javascript">
 		$(document).ready(function(){
 			$('#alumno').on('keyup', function(){
	 			var data = "alumno="+$(this).val();
	 			//alert(data);
	 			$.ajax({
					type: 'POST',
					url: 'buscarAlumnoEmp.php',
					data: (data),
					success: function(resp){
						if (resp!="") {
							$('#alumnos').html(resp);
						}	
					}
				})
			});
 		});

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

				function enviarDatos(dato){
				var ajax=objetoAjax();
				var url = 'verAusenciasAlumnos.php'; 
				  ajax.open("POST", url, true);
				  ajax.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				  ajax.onreadystatechange=function() {
				  	if (ajax.readyState==4) {
						document.getElementById('ausencias').innerHTML = ajax.responseText;
					}
				  }
  				ajax.send("dato="+dato);
				}

			document.load = enviarDatos('');
 	</script>
 </head>
 <body>
 <div><a href="proc/logout.proc.php">Cerrar sessión</a></div>
 <h1>Buscar Alumno</h1>
 <input id="alumno" type="text" name="alumno">
 <div id="alumnos"></div>
<?php
		$Validaciones_sql = "SELECT * FROM validacion INNER JOIN convenio ON convenio.con_id = validacion.val_convenioid INNER JOIN alumno ON alumno.alu_id = convenio.con_alumnoid WHERE con_empresaid = $_SESSION[id] AND val_validado = '0'";
		$validaciones = mysqli_query($conexion, $Validaciones_sql);
		$num_validaciones = mysqli_num_rows($validaciones);
		echo "<h1>Validaciones pendientes ($num_validaciones)</h1>";
		if (mysqli_num_rows($validaciones)>0){
		echo "<table border>";
			echo "<tr>";
				echo "<th>Apellidos</th>";
				echo "<th>Nombre</th>";
				echo "<th>Correo</th>";
				echo "<th>Telf</th>";
				echo "<th></th>";
			echo "</tr>";
		 while($validacion = mysqli_fetch_object($validaciones)){
		 	echo "<tr>";
		 		echo "<td>$validacion->alu_apellido1 $validacion->alu_apellido2</td>";
		 		echo "<td>$validacion->alu_nombre</td>";
		 		echo "<td>$validacion->alu_email</td>";
		 		echo "<td>$validacion->alu_telf</td>";
		 		echo "<td><a href='validarAlumnoEmp.php?id=$validacion->alu_id&mes=$validacion->val_mes'>Validar</a></td>";	
		 	echo "</tr>";
		}
	} else {
		echo "Sin alumnos por validar";
	}


	echo "<h1>Ausencias</h1>";
	echo "<div id='ausencias'></div>";

	 ?>
 </body>
 </html>