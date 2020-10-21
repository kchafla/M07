<?php
    session_start();
    include "../funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (comprovar_email($_REQUEST["user"]) && comprovar_contra($_REQUEST["password"])) {
            $_SESSION["user"] = comprovar_campo($_REQUEST["user"]);
            $_SESSION["password"] = comprovar_campo($_REQUEST["password"]);
            header("Location: UF1-A4-ExerciciPrivat.php");
        } else {
            echo "<p>Datos incorrectos!</p>";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <form method="post">
            <label>Email: </label><input type="text" name="user"/><br>
            <label>Contraseña: </label><input type="password" name="password"/><br>
            <button type="submit">Iniciar sesión</button>
        </form>
    </body>
</html>