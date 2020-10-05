<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>UF1-A2-Exercici1</title>
</head>
<body>
	<?php
		$a1 = Array( 'A','B','C','D' );
		$a2 = Array( 1,2,3,4,5,6,7);
		$a3 = Array( 'Boli', 'Goma', 'Llapis', 'Escurça' );
		$a = Array( 'Lletres' => $a1, 'Números' => $a2, 'Materials Oficina' => $a3 );

		echo "<ul>";
		foreach($a as $listas => $lista){
			echo "<li>$listas: ";
			foreach($lista as $valor){
				echo $valor;
				if($valor != end($lista)){
					echo ", ";
				}
			}
			echo "</li>";
		}
		echo "</ul>";
	?>
</body>
</html>