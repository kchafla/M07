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
        if (isset($_REQUEST["registrarse"])) {
            header("Location: UF1-A5-ExerciciRegistre.php");
        }

        if (isset($_REQUEST["aceptar"])) {
            if ($_REQUEST["aceptar"] == "Si") {
                setcookie("aceptado", 1, time() + 365 * 24 * 60 * 60);
                header("Location: UF1-A5-ExerciciPublic.php");
            } else {
                header("Location: https://www.google.es");
            }
        } else {
            $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

            $user = $_REQUEST["user"];
            $password = $_REQUEST["password"];
            
            $sql = "SELECT * FROM Usuarios WHERE user='$user' and password='$password'";
            $result = $conn->prepare($sql);
            if (!$result = $conn->query($sql)) {
                die("Error al ejecutar la consulta: ".$mysqli->error);
            }

            if (comprovar_email($user) && comprovar_contra($password)) {
                if ($result->num_rows > 0) {
                    while ($usuario = $result->fetch_assoc()) {
                        $_SESSION["user"] = comprovar_campo($usuario["user"]);
                        $_SESSION["password"] = comprovar_campo($usuario["password"]);
                        $conn->close();
                        header("Location: UF1-A5-ExerciciPrivat.php");
                    }
                } else {
                    echo "<p>Datos incorrectos!</p>";
                }
            } else {
                echo "<p>Has escrito el correo/contraseña incorrectamente!</p>";
            }
            
            $conn->close();
        }
    }

    if (isset($_COOKIE["aceptado"])) {
?>
<form method="post">
    <label>Email: </label><input type="text" name="user"/><br>
    <label>Contraseña: </label><input type="password" name="password"/><br><br>
    <label>Recordar contraseña?</label><input type="checkbox" name="recordar" value="1"/><br><br>
    <button type="submit">Iniciar sesión</button>
    <button type="submit" name="registrarse" value="Si">Registrarse</button>
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