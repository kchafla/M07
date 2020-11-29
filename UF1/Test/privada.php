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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["logout"])) {
            cerrar_session();
        }
    }

    if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {   
?>
<form method="post">
    <label>Cerrar sesion: </label><button type="submit" name="logout" value="si">Log out</button>
</form>
<?php
    } else {
        header("Location: index.php");
    }
?>
</body>
</html>