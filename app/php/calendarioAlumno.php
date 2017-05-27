<?php 
include '../../bd_con/conexion.php';
session_start();
include 'restriccion/restriccion.php';

$showmonth = $_POST['showmonth'];
$showyear=$_POST['showyear'];

	$inicio_fin_sql = "SELECT * FROM horario_convenio WHERE hr_convenioid='$_SESSION[convenio]'";
	$inicio_fin_s = mysqli_query($conexion, $inicio_fin_sql);
	while ($inicio_fin = mysqli_fetch_object($inicio_fin_s)) {
		$inicio = $inicio_fin->hr_dia_inicio;
		$fin = $inicio_fin->hr_dia_final;
	}

$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showmonth);
$pre_days = date('w', mktime(0, 0, 0, $showmonth, 0, $showyear));
$post_days = (7 - (date('w', mktime(0, 0, 0, $showmonth, $day_count, $showyear))));

$dh=0;
for ($i=1; $i <= $day_count ; $i++) { 
	$time = "$i/$showmonth/$showyear";
	$time = str_replace('/', '-', $time);
	$time = date('Y-m-d', strtotime($time));
	if(date('w', strtotime($time)) != 6 && date('w', strtotime($time)) != 0 && $time >= $inicio && $time <= $fin) {
		$dh++;
	}
}
$month = date('m', strtotime($time));
$validar_sql = "SELECT DISTINCT tar_fecha FROM tarea WHERE MONTH(tar_fecha) = $month AND tar_convenioid=$_SESSION[convenio]";
$validar = mysqli_query($conexion, $validar_sql);
if (mysqli_num_rows($validar)==$dh && $dh!=0){
	$verficar_sql = "SELECT * FROM validacion 	WHERE val_mes = $month AND val_convenioid = '$_SESSION[convenio]'";
	$verificar = mysqli_query($conexion, $verficar_sql);
	if(mysqli_num_rows($verificar)==0){
		
		$insert = "INSERT INTO `validacion` (`val_id`, `val_validado`, `val_mes`, `val_convenioid`) VALUES (NULL, '0', $month, '$_SESSION[convenio]')";
		mysqli_query($conexion, $insert);

		$val_id = mysqli_insert_id($conexion);
		/*-----------------------*/

		$tipo_tar_sql = "SELECT DISTINCT tipo_h_tarea.tip_tar_id, tipo_h_tarea.tip_tar_descripcion FROM tipo_h_tarea INNER JOIN tipo_tarea ON tipo_tarea.tt_tiphtarid = tipo_h_tarea.tip_tar_id WHERE tt_cicloid = $_SESSION[ciclo]";
 	 	$tipo_tars = mysqli_query($conexion, $tipo_tar_sql);

 		while ($tipo_tar = mysqli_fetch_object($tipo_tars)) {			
	 			$tarea_sql = "SELECT * FROM tipo_tarea WHERE tt_tiphtarid = '$tipo_tar->tip_tar_id'";
	 			$tareas = mysqli_query($conexion, $tarea_sql);

	 			while ($tarea = mysqli_fetch_object($tareas)) {
	 				$tar_sql = "SELECT SUM(tar_duracion) as horas FROM tarea WHERE tar_convenioid='$_SESSION[convenio]' AND tar_tiptareaid = '$tarea->tt_id' AND MONTH(tar_fecha)='$month'";
	 				$tars = mysqli_query($conexion, $tar_sql);
	 				while($tar = mysqli_fetch_object($tars)){
	 					if ($tar->horas != null){	
	 						$hours = $tar->horas;
	 					} else {
	 						$hours = 0;
	 					}
	 					$insert = "INSERT INTO validar_tarea (vt_id, vt_totalHoras, vt_NotaEmpresa, vt_validacionid, vt_tipotareaid) VALUES (NULL, '$hours', NULL, $val_id, $tarea->tt_id)";
	 					mysqli_query($conexion, $insert);
	 				}
	 	
	 			}
 		}

		/*-----------------------*/
	}

	$sql = "SELECT * FROM validacion WHERE val_convenioid = $_SESSION[id] AND (val_validado='1' OR val_validado='2') AND val_mes ='$month'";
	$val = mysqli_query($conexion, $sql);
	if (mysqli_num_rows($val)>0){
		$validator = 'valdiar';
	}
}

$day = date("d");
$mes  = date("m");
$ano = date('Y');

	if (strstr($mes, '0')){
		$mes = substr($mes, -1);
	}	

$hoy = "$day/$mes/$ano";
	
echo "<div class='col-sm-12 center meses-opc'>";
	echo "<div class='col-sm-3 col-xs-4'><button class='btn btn-default' onclick='prev_month($showmonth, $showyear);'><i class='fa fa-arrow-left' aria-hidden='true'></i></button></div>";
	echo "<div class='col-sm-5 col-xs-4'>".$showmonth."/".$showyear."</div>";
	echo "<div class='col-sm-3 col-xs-4'><button class='btn btn-default' onclick='next_month($showmonth, $showyear);'><i class='fa fa-arrow-right' aria-hidden='true'></i></button></div>";
	echo "<div class='col-sm-1 col-xs-3'><a href='#' class='boton-info' title='Info' data-toggle='modal' data-target='#myModal'><i class='fa fa-info-circle fa-2x' aria-hidden='true'></i></a></div>";
echo "</div>";

echo "<div class='col-sm-12' id='tareasAlumno'>";


if(isset($validator)){
	echo "<p class='bg-info'><a href='verValidacion.php?mes=$month'>Ver validación</a></p>";
}
echo "</div>";
echo "<br><br>";
echo "<div class='week_days'>";
	echo "<div class='days_of_week'>LUNES</div>";
	echo "<div class='days_of_week'>MARTES</div>";
	echo "<div class='days_of_week'>MIÉRCOLES</div>";
	echo "<div class='days_of_week'>JUEVES</div>";
	echo "<div class='days_of_week'>VIERNES</div>";
	echo "<div class='days_of_week'>SÁBADO</div>";
	echo "<div class='days_of_week'>DOMINGO</div>";
	echo "<div class='clear'></div>";
echo "</div>";

if ($pre_days != 0) {
	for ($i=1; $i<=$pre_days ; $i++) { 
		echo "<diV class='non_cal_day'></div>";
	}
}

	$hoy_t = str_replace('/', '-', $hoy);
	$hoy_t = date('Y-m-d', strtotime($hoy_t));

for ($i=1; $i<=$day_count ; $i++) { 
	$dia = "$i/$showmonth/$showyear";

	$dia_t = str_replace('/', '-', $dia);
	$dia_t = date('Y-m-d', strtotime($dia_t));

	$dia_completo_sql = "SELECT * FROM tarea INNER JOIN convenio ON convenio.con_id = tarea.tar_convenioid WHERE con_alumnoid = $_SESSION[id] AND tar_fecha = '$dia_t'";
	$dia_completos = mysqli_query($conexion, $dia_completo_sql);

	if (mysqli_num_rows($dia_completos)>0) {
			$color = "background-color:#82E0AA;";
			$update = "update";
			}

		$ausencia_sql = "SELECT * FROM ausencia WHERE fecha = '$dia_t' AND aus_convenioid = $_SESSION[convenio]";
		$ausencias = mysqli_query($conexion, $ausencia_sql);
		if(mysqli_num_rows($ausencias)>0){
			$color = "background-color:#F1948A;";
			$update= "update";
		}

	$time = "$showyear/$showmonth/$i";

	if(date('w', strtotime($time)) == 6 || date('w', strtotime($time)) == 0) {
		$estilo = "background-color:#E5E8E8;";
	}

	if ($dia == $hoy) {
		$color = "border: 5px solid green";
	}

	if (isset($validator)){
		$color = "background-color:#A9CCE3;";
	}

	if ($dia_t<$inicio || $dia_t>$fin) {
		$color = "background-color:#E5E8E8;";
	}

		
		if(isset($estilo)){
			echo "<div class='cal_day' style='$estilo'>";

			?>
			<div class="day_heading"><?php echo "$i"?></div>
		<?php	
		echo "</div>";
		} else if ($hoy_t < $dia_t || $dia_t<$inicio || $dia_t>$fin || isset($validator)) {
			$div = "<diV class='cal_day' ";
			if(isset($color)){
				$div .= "style='$color";
			}
			$div .= "'>";
			echo "$div";
			?>
			<div class="day_heading"><?php echo "$i"?></div>
		<?php	
		echo "</div>";
		} else {
			if (isset($update)){
				?>
			<a href="#" onclick="mostrarDias(<?php echo " '$dia'"; ?>, 'update');">
			<?php
			}else{
				?>
			<a href="#" onclick="mostrarDias(<?php echo " '$dia'"; ?>, 'insert');">
			<?php
			}
			$div = "<diV class='cal_day' ";
			if(isset($color)){
				$div .= "style='$color";
			}
			$div .= "'>";
			echo "$div";
			?>
			<div class="day_heading"><?php echo "$i"?></div>
		<?php	
		echo "</div></a>";

		}

	$estilo = null;
	$color = null;
	$update = null;
}


if ($post_days != 0) {
	for ($i=1; $i <= $post_days ; $i++) { 
		echo "<diV class='non_cal_day'></div>";
	}
}

 ?>
<!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><i class="fa fa-info-circle" aria-hidden="true"></i>
</button>
 -->
	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog modal-sm">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">LEYENDA</h4>
	        </div>
	        <div class="modal-body">
	          	<p class="pad-p" style="border: 5px solid green">Hoy</p>
			 	<p class="pad-p" style="background-color:#F9E79F">Días no realizados</p>
				<p class="pad-p" style="background-color:#82E0AA">Días realizados</p>
			 	<p class="pad-p" style="background-color:#F1948A">Días con faltas</p>
			 	<p class="pad-p" style="background-color:#A9CCE3">Días validados</p>
			 	<p class="pad-p" style="background-color:#E5E8E8">Fines de semana + días fuera de periodo</p> 	
	        </div>
	      </div>
	    </div>
	  </div>

