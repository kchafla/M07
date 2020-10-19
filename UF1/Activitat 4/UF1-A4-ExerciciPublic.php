<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_REQUEST["user"] == "kchaflam@fp.insjoaquimmir.cat" && $_REQUEST["password"] == "alumne") {
            $_SESSION["user"] = $_REQUEST["user"];
            $_SESSION["password"] = $_REQUEST["password"];
            header("Location: UF1-A4-ExerciciPrivat.php");
        } else {
            echo "Datos incorrectos!";
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