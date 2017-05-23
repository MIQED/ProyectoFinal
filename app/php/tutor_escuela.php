<?php 
session_start();
include 'restriccion/restriccion.php';
include '../../bd_con/conexion.php';

unset($_SESSION["al"]);
echo "$_SESSION[nombre]";
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
 <div><a href="proc/logout.proc.php">Cerrar sessión</a></div>
 <h1>Buscar Alumno</h1>
 <input id="alumno" type="text" name="alumno">
 <div id="alumnos"></div>
 <?php 
 $validaciones_0_sql = "SELECT * FROM validacion INNER JOIN convenio ON convenio.con_id = validacion.val_convenioid INNER JOIN 	alumno ON alumno.alu_id = convenio.con_alumnoid INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE cic_tutescid = $_SESSION[id] AND val_validado = '0'";
 $validaciones_0 = mysqli_query($conexion, $validaciones_0_sql);
 $num_validaciones_0 = mysqli_num_rows($validaciones_0);

 echo "<h1>Validaciones empresa ($num_validaciones_0)</h1>";

 	if(mysqli_num_rows($validaciones_0)>0){
 		echo "<table border>";
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
		 		echo "<td><a href='validarAlumnoEmp.php?id=$validacion->alu_id&mes=$validacion->val_mes'>Validar</a></td>";	
		 	echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "Sin alumnos por validar";
	}



 $validaciones_1_sql = "SELECT * FROM validacion INNER JOIN convenio ON convenio.con_id = validacion.val_convenioid INNER JOIN 	alumno ON alumno.alu_id = convenio.con_alumnoid INNER JOIN ciclo ON ciclo.cic_id = alumno.alu_cicloid WHERE cic_tutescid = $_SESSION[id] AND val_validado = '1'";
 $validaciones_1 = mysqli_query($conexion, $validaciones_1_sql);
 $num_validaciones_1 = mysqli_num_rows($validaciones_1);

 echo "<h1>Validaciones escuela ($num_validaciones_1)</h1>";

 if(mysqli_num_rows($validaciones_1)>0){
 		echo "<table border>";
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
		 		echo "<td><a href='validarAlumnoEmpEsc.php?id=$validacion->alu_id&mes=$validacion->val_mes'>Validar</a></td>";	
		 	echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "Sin alumnos por validar";	
	}


  ?>
 </body>
 </html>