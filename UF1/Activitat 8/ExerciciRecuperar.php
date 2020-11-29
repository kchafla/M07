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

    if (isset($_REQUEST["newpass"]) && !comprovar_contra($_REQUEST["newpass"])) {
        echo "<p>Has escrito la contraseña incorrectamente!</p>";
    }
    if (isset($_REQUEST["new"]) && comprovar_contra($_REQUEST["newpass"])) {
        $user = codigo_correo($_REQUEST["codi"]);
        cambiar_password(md5($_REQUEST["newpass"]), $user, $_REQUEST["codi"]);
        echo "<p>Has cambiado tu contraseña correctamente!</p>";
        echo '<form action="ExerciciPublic.php" method="post">
                <h3>Volver a la pagina principal: <button type="submit">Menu</button></h3>
            </form>';
    } else if (comprovar_codigo($_REQUEST["codi"])) {
?>
<table border="1">
    <form method="post">
        <tr><td><label>Nueva contraseña: </label></td><td><input type="password" name="newpass"></td></tr>
<?php
        echo "<input type='hidden' name='codi' value='".$_REQUEST["codi"]."'>"
?>
        <tr><td colspan="2" style="text-align: center;"><button type="submit" name="new" value="Si">Cambiar</button></td></tr>
    </form>
</table>
<?php
    } else {
        header("Location: ExerciciPublic.php");
    }
?>
</body>
</html>