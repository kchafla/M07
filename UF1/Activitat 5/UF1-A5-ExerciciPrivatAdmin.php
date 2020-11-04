<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome admin!</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["salir"])) {
            cerrar_session();
        }
        
        if (isset($_REQUEST["password"]) && isset($_REQUEST["newuser"]) && isset($_REQUEST["newpassword"])) {
            modificar_usuario($_SESSION["user"], md5($_REQUEST["password"]), $_REQUEST["newuser"], md5($_REQUEST["newpassword"]));
        }
    }
    
    if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
        echo "<h2>Hola ".$_SESSION["user"]."!</h2><br>";
?>
<h3>Tabla de administración:</h3>
<?php
    generar_tabla_admin();
?>
<form method="post">
    <br><h3>Cerrar sesion: <button type="submit" name="salir" value="si">Salir</button></h3>
</form>
<?php
    } else {
        header("Location: UF1-A5-ExerciciPublic.php");
    }
?>
</body>
</html>