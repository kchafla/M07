<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de administracion</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["salir"])) {
            cerrar_session();
        }

        if (isset($_REQUEST["modificar"])) {
            modificar_usuario_admin($_REQUEST['id'], $_REQUEST['newuser'], md5($_REQUEST['newpassword']), $_REQUEST['newrol']);
        } else if (isset($_REQUEST["borrar"])) {
            borrar_usuario($_REQUEST["newuser"]);
        } else if (isset($_REQUEST["crear"])) {
            registrar_usuario($_REQUEST["reguser"], md5($_REQUEST["regpassword"]), $_REQUEST["regrol"]);
        }
    }
    
    if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
        echo "<h2>Hola ".$_SESSION["user"]."!</h2>";
?>
<form method="post">
    <h3>Cerrar sesion: <button type="submit" name="salir" value="si">Salir</button></h3>
</form><br>
<h3>Tabla de administración:</h3>
<?php
        generar_tabla_admin();
?>
<h3>Tabla de transacciones:</h3>
<?php
        generar_transacciones_admin();
    } else {
        header("Location: ExerciciPublic.php");
    }
?>
</body>
</html>