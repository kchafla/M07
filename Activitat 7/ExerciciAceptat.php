<?php
    session_start();
include "funcions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra realizada</title>
</head>
<body>
<?php
    if (isset($_SESSION["clave"])) {
        if ($_GET["clave"] == $_SESSION["clave"]) {
            unset($_SESSION["clave"]);
            acabar_transaccion();
        }
    } else {
        header("Location: ExerciciDenegat.php");
    }
?>
<form action="ExerciciPublic.php" method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="si">Volver</button></h3>
</form>
</body>
</html>