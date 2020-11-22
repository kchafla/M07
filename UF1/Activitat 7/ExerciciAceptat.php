<?php
    session_start();
include "funcions.php";
?>
<html>
<head>
  <title>Compra realizada!</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    if ($_GET["clave"] == $_SESSION["clave"]) {
        unset($_SESSION["clave"]);
        echo "hgola";
    } else {
        header("Location: ExerciciDenegat.php");
    }
?>
<p>El ha sido realizado con exito!</p>
<form action="ExerciciPublic.php" method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="si">Volver</button></h3>
</form>
</body>
</html>