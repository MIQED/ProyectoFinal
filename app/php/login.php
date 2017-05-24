<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>APP</title>
</head>
<body>
	<form action="proc/login.proc.php" method="POST">
		<div class="form-group">
		  <label for="correo">E-mail: </label>
		  <input type="email" class="form-control" id="correo" name="correo">
		</div>
		<div class="form-group">
		  <label for="pass">Contraseña: </label>
		  <input type="password" class="form-control" id="pass" name="pass">
		</div>
		<div class="center">
			<input type="submit" name="enviar" class="btn btn-default" value="Entrar">	
		</div>
	</form>
</body>
</html>