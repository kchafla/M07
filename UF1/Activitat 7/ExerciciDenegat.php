<?php
session_start();
include "funcions.php";
?>
<html>
<head>
  <title>Checkout canceled</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_REQUEST["volver"])) {
        header("Location: ExerciciPublic.php");
    }
  }
?>
<p>El pago ha sido cancelado!</p>
<form method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="si">Volver</button></h3>
</form>
</body>
</html>