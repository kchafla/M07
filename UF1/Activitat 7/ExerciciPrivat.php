<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina privada</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["volver"])) {
            header("Location: ExerciciPublic.php");
        }

        if (isset($_REQUEST["salir"])) {
            cerrar_session();
        }

        if (isset($_REQUEST["modificar"])) {
            if (isset($_REQUEST["password"]) && isset($_REQUEST["newuser"]) && isset($_REQUEST["newpassword"])) {
                modificar_usuario($_SESSION["user"], md5($_REQUEST["password"]), $_REQUEST["newuser"], md5($_REQUEST["newpassword"]));
            } else {
                echo "<p>Faltan datos!</p>";
            }
        }

        if (isset($_REQUEST["producto"])) {
            subir_producto($_REQUEST["prodnombre"], $_REQUEST["proddesc"], round($_REQUEST["prodprecio"], 2), $_SESSION["user"]);
        }
        
        if (isset($_REQUEST["modificarprod"])) {
            modificar_producto($_REQUEST["idprod"], $_REQUEST["nomprod"], $_REQUEST["descprod"], round($_REQUEST["preuprod"], 2));
        }

        if (isset($_REQUEST["borrarprod"])) {
            borrar_producto($_REQUEST["idprod"]);
        }
    }
    
    if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
        echo "<h2>Hola ".$_SESSION["user"]."!</h2>";
?>
<form method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="si">Volver</button></h3>
</form>
<form method="post">
    <h3>Cerrar sesion: <button type="submit" name="salir" value="si">Salir</button></h3>
</form><br>
<h3>Modificar tus datos:</h3>
<table border="1">
        <tr><td colspan="2" style="text-align: center;">Es necessario poner tu contraseña.</td></tr>
        <form method="post">
            <tr><td style="text-align: right;"><label>Tu contraseña: </label></td><td><input type="password" name="password"></td></tr>
            <tr><td style="text-align: right;"><label>Nuevo correo: </label></td><td><input type="text" name="newuser"></td></tr>
            <tr><td style="text-align: right;"><label>Nueva contraseña: </label></td><td><input type="password" name="newpassword"></td></tr>
            <tr><td colspan="2" style="text-align: center;"><label><button type="submit" name="modificar" value="Si">Modificar</button></label></td></tr>
        </form>
</table><br>
<h3>Subir un producto:</h3>
<table border="1">
        <form method="post">
            <tr><td style="text-align: right;"><label>Nombre: </label></td><td><input type="text" name="prodnombre" size="28"></td></tr>
            <tr><td style="text-align: right;"><label>Descripcion: </label></td><td><textarea style='resize: none;' name="proddesc" cols="42" rows="5" maxlength="200"></textarea></td></tr>
            <tr><td style="text-align: right;"><label>Precio (€): </label></td><td><input type="text" name="prodprecio" size="28"></td></tr>
            <tr><td colspan="2" style="text-align: center;"><label><button type="submit" name="producto" value="Si">Subir</button></label></td></tr>
        </form>
</table><br>
<h3>Tus productos:</h3>
<?php
        tabla_productos_usuario($_SESSION["user"]);
    } else {
        header("Location: ExerciciPublic.php");
    }
?>
</body>
</html>