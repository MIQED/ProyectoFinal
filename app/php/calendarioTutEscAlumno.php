<?php 
include '../../bd_con/conexion.php';
session_start();

$showmonth = $_POST['showmonth'];
$showyear=$_POST['showyear'];

$day_count = cal_days_in_month(CAL_GREGORIAN, $showmonth, $showmonth);
$pre_days = date('w', mktime(0, 0, 0, $showmonth, 0, $showyear));
$post_days = (7 - (date('w', mktime(0, 0, 0, $showmonth, $day_count, $showyear))));

$dh = 0;
for ($i=1; $i<=$day_count ; $i++) { 
	$time = "$showyear/$showmonth/$i";
	if(date('w', strtotime($time)) != 6 && date('w', strtotime($time)) != 0) {
		$dh++;
	}
}

$day = date("d");
$mes  = date("m");
$ano = date('Y');

	if (strstr($mes, '0')){
		$mes = substr($mes, -1);
	}	

$hoy = "$day/$mes/$ano";
	
echo "<div class='title_bar'>";
	echo "<div class='previous_month'><button onclick='prev_month($showmonth, $showyear);'>Anterior</button></div>";
	echo "<div class='show_month'>".$showmonth."/".$showyear."</div>";
	echo "<div class='next_month'><button onclick='next_month($showmonth, $showyear);'>Siguiente</button></div>";
echo "</div>";

echo "<div id='tareasAlumno'>";
echo "</div>";


echo "<br><br><br><br>";
echo "<div class='week_days'>";
	echo "<div class='days_of_week'>Lunes</div>";
	echo "<div class='days_of_week'>Martes</div>";
	echo "<div class='days_of_week'>Miércoles</div>";
	echo "<div class='days_of_week'>Jueves</div>";
	echo "<div class='days_of_week'>Viernes</div>";
	echo "<div class='days_of_week'>Sábado</div>";
	echo "<div class='days_of_week'>Domingo</div>";
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

	$dia_completo_sql = "SELECT * FROM tarea INNER JOIN convenio ON convenio.con_id = tarea.tar_convenioid WHERE con_alumnoid = $_SESSION[al] AND tar_fecha = '$dia_t'";
	$dia_completos = mysqli_query($conexion, $dia_completo_sql);

	if (mysqli_num_rows($dia_completos)>0) {
			$color = "background-color:yellow;";
			$update = "update";
			}

	$time = "$showyear/$showmonth/$i";

	if(date('w', strtotime($time)) == 6 || date('w', strtotime($time)) == 0) {
		$estilo = "background-color:#ccc;";
	}

	if ($dia == $hoy) {
		$color = "background-color:green;";
	}
		
		if(isset($estilo)){
			$div = "<div class='cal_day' style='$estilo";
			if(isset($color)){
				$div .= "$color";
			}
			$div .= "'>";
			echo "$div";
			?>
			<div class="day_heading"><?php echo "$i"?></div>
		<?php	
		echo "</div>";
		} else if ($hoy_t < $dia_t) {
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
				<a href="#" onclick="mostrarDias(<?php echo " '$dia'"; ?>);">
				<?php
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
			}else{

			$div = "<diV class='cal_day' ";
			if(isset($color)){
				$div .= "style='$color";
			}
			$div .= "'>";
			echo "$div";
				echo "<div class='day_heading'>$i</div>";	
			echo "</div>";

			}
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



echo "$dh";
 ?>