<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UF1-A2-Practica</title>
</head>
<body>
	<?php
		$mes = date("F");
		$espai = 1;
		echo "<table border='1'>";
		echo "<tr><th colspan='7'>$mes</th></tr>";
		echo "<tr><td>L</td><td>M</td><td>X</td><td>J</td><td>V</td><td>S</td><td>D</td></tr><br><tr>";
		for ( $dia=1; $dia<=date("w",strtotime(date("Y").date("n")."01")); $dia++ ){
			if ( $dia == date("w",strtotime(date("Y").date("n")."01")) ){
				for ( $dia=1; $dia<=date("t"); $dia++ ){
					if( $dia == date("j") ){
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
		echo "me parece bien";
	?>
</body>
</html>