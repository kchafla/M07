<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UF1-A2-Practica</title>
</head>
<body>
	<?php
		for ( $m=0; $m < 12; $m++) {
			$mes = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
			$mesactual = date("F");
			$espai = 1;
			if ( $mesactual == $mes[$m] ) {
				echo "<table style='background-color:#fadbd8;' border='1'>";
			} else {
				echo "<table style='background-color:#fdf2e9;' border='1'>";
			}
			echo "<tr><th colspan='7'>$mes[$m]</th></tr>";
			echo "<tr><td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><br><tr>";
			for ( $dia=1; $dia<=date("N",strtotime("01".$mes[$m].date("Y"))); $dia++ ){
				if ( $dia == date("N",strtotime("01".$mes[$m].date("Y")))){
					for ( $dia=1; $dia<=date("t"); $dia++ ){
						if( $dia == date("j") && $mesactual == $mes[$m]){
							echo "<td style='color:red'>$dia</td>";
						} else {
							echo "<td>$dia</td>";
						}
						if( ($espai%7) == 0 ){
							echo "</tr><tr>";
						}
						$espai++;
					}
				} else {
					echo "<td></td>";
				}
				$espai++;
			}
			echo "</table>";
		}
	?>
</body>
</html>