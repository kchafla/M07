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
        if (isset($_REQUEST["login"])) {
            iniciar_sesion(comprovar_campo($_REQUEST["user"]), comprovar_campo($_REQUEST["password"]));
        }

        if (isset($_REQUEST["recuperar"])) {
            header("Location: recuperar.php");
        }
    }
?>
    <table border="1">
        <form method="post">
            <tr><th colspan="2">Escribe tus datos!</th></tr>
            <tr><td><label>Correo: </label></td><td><input type="text" name="user"></td></tr>
            <tr><td><label>Contraseña: </label></td><td><input type="password" name="password"></td></tr>
            <tr><td colspan="2" style="text-align: center;"><button type="submit" name="login" value="si">Entrar</button></td></tr>
        </form>
    </table>
    <br>
    <form method="post">
        <label><strong>Recuperar contraseña:</strong> </label><button type="submit" name="recuperar" value="si">Recuperar</button>
    </form>
</body>
</html>