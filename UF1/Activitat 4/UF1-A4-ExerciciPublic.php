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
    include "../funcions.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["aceptar"])) {
            if ($_REQUEST["aceptar"] == "Si") {
                setcookie("aceptado", 1, time() + 365 * 24 * 60 * 60);
                header("Location: UF1-A4-ExerciciPublic.php");
            } else {
                header("Location: https://www.google.es");
            }
        } else {
            if (comprovar_email($_REQUEST["user"]) && comprovar_contra($_REQUEST["password"])) {
                $_SESSION["user"] = comprovar_campo($_REQUEST["user"]);
                $_SESSION["password"] = comprovar_campo($_REQUEST["password"]);
                header("Location: UF1-A4-ExerciciPrivat.php");
            } else {
                echo "<p>Datos incorrectos!</p>";
            }
        }
    }

    if (isset($_COOKIE["aceptado"])) {
?>
<form method="post">
    <label>Email: </label><input type="text" name="user"/><br>
    <label>Contraseña: </label><input type="password" name="password"/><br>
    <label>Recordar contraseña?</label><input type="checkbox" name="recordar" value="1"/><br>
    <button type="submit">Iniciar sesión</button>
</form>
<?php
    } else {
?>
<form method="post">
    <label>Esta pagina usa cookies, quieres continuar?</label><br>
    <button type="submit" name="aceptar" value="Si">Si. </button>
    <button type="submit" name="aceptar" value="No">No.</button>
</form>
<?php
    }
?>
</body>
</html>