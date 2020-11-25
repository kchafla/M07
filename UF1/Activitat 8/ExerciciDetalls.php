<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaccion detallada</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["volver"])) {
            header("Location: ExerciciPrivatAdmin.php");
        }
?>
<form method="post">
    <h3>Volver a tu pagina privada: <button type="submit" name="volver" value="si">Volver</button></h3>
</form>
<?php
        tabla_productos_transacciones($_REQUEST["id"]);
    } else {
        header("Location: ExerciciPrivatAdmin.php");
    }
?>
</body>
</html>