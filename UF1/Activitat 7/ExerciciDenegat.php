<?php
session_start();
include "funcions.php";
?>
<html>
<head>
  <title>Orden cancelada</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
  if (isset($_SESSION["clave"])) {
    unset($_SESSION["clave"]);
?>
<p>El pago ha sido cancelado!</p>
<form action="ExerciciPublic.php" method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="si">Volver</button></h3>
</form>
<?php
  } else {
    header("Location: ExerciciPublic.php");
  }
?>
</body>
</html>