<?php
function comprovar_campo($string) {
    $string = trim($string);
    $string = stripslashes($string);
    $string = htmlspecialchars($string);
    return $string;
}

function comprovar_email($mail) {
    $mail = comprovar_campo($mail);
    if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $emailError = True;
    } else {
        $emailError = False;
    }
    return $emailError;
}

function comprovar_contra($password) {
    $password = comprovar_campo($password);
    if (!preg_match("/[^a-zA-Z\d]/",$password)) {
        $contraError = True;
    } else {
        $contraError = False;
    }
    return $contraError;
}

function generar_string($length = 6) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function iniciar_sesion($mail, $password) {
    if (comprovar_email($mail) && comprovar_contra($password)) {
        $password = md5($password);
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
                
        $sql = "SELECT * FROM Usuarios WHERE user='$mail' and password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $_SESSION["user"] = $usuario["user"];
            $_SESSION["password"] = $usuario["password"];
            
            $conn->close();
            header("Location: privada.php");
        } else {
            echo "<p>Datos incorrectos!</p>";
        }
    } else {
        echo "<p>Has escrito el correo/contraseña incorrectamente!</p>";
    }
}

function cerrar_session() {
    session_unset();
    session_regenerate_id();
    session_destroy();
    header("Location: index.php");
}

function codigo_db($codi, $user) {
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "INSERT INTO Recuperacion VALUES ('$codi', '$user')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Pin generado!</p>";
    } else {
        echo "Error: ".$sql."<br>".$conn->error;
    }

    $conn->close();
}

function comprovar_email_db($user) {
    if (comprovar_email($user)) {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
                
        $sql = "SELECT * FROM Usuarios WHERE user='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            return true;
        } else {
            echo "<p>Datos incorrectos!</p>";
            return false;
        }
    } else {
        echo "<p>Has escrito el correo/contraseña incorrectamente!</p>";
        return false;
    }
}

function comprovar_codigo($codi) {
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
                
    $sql = "SELECT * FROM Recuperacion WHERE codi='$codi'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return true;
    } else {
        return false;
    }
}

function cambiar_password($password, $user, $codi) {
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "UPDATE Usuarios SET password='$password' WHERE user='$user'";
    $result = $conn->query($sql);

    $sql = "DELETE FROM Recuperacion WHERE codi='$codi'";
    $result = $conn->query($sql);

    $conn->close();
    echo "<p>Has cambiado la contraseña correctamente!</p>";
}

function codigo_correo($codi) {
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
                
    $sql = "SELECT user FROM Recuperacion WHERE codi='$codi'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();

    return $usuario["user"];
}
?>