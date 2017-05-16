<?php 
session_start();

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
 </body>
 </html>