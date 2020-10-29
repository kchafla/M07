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
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["salir"])) {
            session_unset();
            session_regenerate_id();
            session_destroy();
            header("Location: UF1-A5-ExerciciPublic.php");
        }

        if (isset($_REQUEST["password"]) && isset($_REQUEST["newuser"]) && isset($_REQUEST["newpassword"])) {
            $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

            $password = $_REQUEST["password"];
            $user = $_SESSION["user"];
            if ($password != $_SESSION["password"]) {
                echo "<p>La contraseña no coincide!</p>";
            } else {
                $newuser = $_REQUEST["newuser"];
                $newpassword = $_REQUEST["newpassword"];

                $sql = "UPDATE Usuarios SET user='$newpassword' and password='$newpassword' WHERE user='$user' and password='$password'";
                if (!$result = $conn->query($sql)) {
                    die("Error al ejecutar la actualizacion: ".$mysqli->error);
                }

                echo "usuario actualizado!";
            }
        }
    }
    
    if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
        echo "<p>Hola ".$_SESSION["user"]."!</p><br>";
?>
<h3>Modificar tus datos:</h3>
<form method="post">
    <label>Tu contraseña: </label><input type="password" name="password"><br>
    <label>Nuevo correo: </label><input type="text" name="newuser"><br>
    <label>Nueva contraseña: </label><input type="password" name="newpassword"><br>
    <button type="submit">Modificar</button><br><br><br>
    <button type="submit" name="salir" value="si">Salir</button>
</form>
<?php
    } else {
        header("Location: UF1-A5-ExerciciPublic.php");
    }
?>
</body>
</html>