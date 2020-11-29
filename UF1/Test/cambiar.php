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
    if (isset($_REQUEST["volver"])) {
        header("Location: index.php");
    }

    if (isset($_REQUEST["cambiar"])) {
        cambiar_password(md5($_REQUEST["password"]), $_REQUEST["mail"], $_REQUEST["pin"]);
?>
<form method="post">
    <label>Volver: </label><button type="submit" name="volver" value="si">Volver</button>
</form>
<?php
    } else if (isset($_REQUEST["comprovar"])) {
        if (comprovar_codigo($_REQUEST["pin"])) {
            $mail = codigo_correo(($_REQUEST["pin"]));
?>
<form method="post">
<?php
    echo '<input type="hidden" name="pin" value="'.$_REQUEST["pin"].'">';
    echo '<input type="hidden" name="mail" value="'.$mail.'">';
?>
    <label>Inctroduce la nueva contraseña: </label><input type="text" name="password">
    <button type="submit" name="cambiar" value="si">Cambiar</button>
</form>
<?php
        }
    } else {
?>
<form method="post">
    <label>Inctroduce el pin: </label><input type="text" name="pin">
    <button type="submit" name="comprovar" value="si">Comprovar</button>
</form>
<?php
    }
?>
</body>
</html>