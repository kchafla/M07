<?php
    session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        session_destroy();
        header("Location: UF1-A4-ExerciciPublic.php");
    } else {
        if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
            echo "<p>Hola ".$_SESSION["user"]."!</p>";
        } else {
            header("Location: UF1-A4-ExerciciPublic.php");
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
            <button type="submit">Salir</button>
        </form>
    </body>
</html>

<?php

    }

?>