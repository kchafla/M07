<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["volver"])) {
            header("Location: ExerciciPublic.php");
        }
?>
<form method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="Si">Menu</button></h3>
</form>
<?php
        informacion_producto($_REQUEST["idprod"]);
    } else {
        header("Location: ExerciciPublic.php");
    }
?>
</body>
</html>