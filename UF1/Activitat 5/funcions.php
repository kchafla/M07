<?php

function comprovar_campo($campo) {
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function comprovar_email($email) {
    $email = comprovar_campo($email);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = True;
    } else {
        $emailError = False;
    }
    return $emailError;
}

function comprovar_contra($contra) {
    $contra = comprovar_campo($contra);
    if (!preg_match("/[^a-zA-Z\d]/",$contra)) {
        $contraError = True;
    } else {
        $contraError = False;
    }
    return $contraError;
}

function crear_cookie($aceptado) {
    if ($aceptado == "Si") {
        setcookie("aceptado", 1, time() + 365 * 24 * 60 * 60);
        header("Location: UF1-A5-ExerciciPublic.php");
    } else {
        header("Location: https://www.google.es");
    }
}

function cerrar_session() {
    session_unset();
    session_regenerate_id();
    session_destroy();
    header("Location: UF1-A5-ExerciciPublic.php");
}

function iniciar_sesion($user, $password) {
    if (comprovar_email($user) && comprovar_contra($password)) {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
                
        $sql = "SELECT * FROM Usuarios WHERE user='$user' and password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $_SESSION["user"] = comprovar_campo($usuario["user"]);
            $_SESSION["password"] = comprovar_campo($usuario["password"]);

            $conn->close();

            header("Location: UF1-A5-ExerciciPrivat.php");
        } else {
            echo "<p>Datos incorrectos!</p>";
        }
    } else {
        echo "<p>Has escrito el correo/contraseña incorrectamente!</p>";
    }
}

function modificar_usuario($user, $password, $newuser ,$newpassword) {
    if ($password != $_SESSION["password"]) {
        echo "<p>La contraseña no coincide!</p>";
    } else if (!comprovar_email($newuser)) {
        echo "<p>No has escrito el correo a modificar correctamente!</p>";
    } else if (!comprovar_contra($newpassword)) {
        echo "<p>No has escrito la nueva contraseña correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

        $sql = "SELECT * FROM Usuarios WHERE user='$user' and password='$password'";
        $result = $conn->query($sql);
        $usuario = $result->fetch_assoc();
        $id = $usuario["id"];

        $sql = "UPDATE Usuarios SET user='$newuser' WHERE id=$id";
        $result = $conn->query($sql);
        $sql = "UPDATE Usuarios SET password='$newpassword' WHERE id=$id";
        $result = $conn->query($sql);

        $conn->close();

        $_SESSION["user"] = $newuser;
        $_SESSION["password"] = $newpassword;
        echo "Usuario actualizado!";
    }
}

function registrar_usuario($user, $password) {
    if (!comprovar_email($user)) {
        echo "<p>No has escrito el correo correctamente!</p>";
    } else if (!comprovar_contra($password)) {
        echo "<p>No has escrito la contraseña correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
        
        $sql = "SELECT * FROM Usuarios WHERE user='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "SELECT MAX(id)+1 FROM Usuarios AS siguienteid";

            $result = $conn->query($sql);
            $siguienteid = array_values($result->fetch_assoc());
            $id = $siguienteid[0];
            
            $sql = "INSERT INTO Usuarios VALUES ('$id','$user','$password','user')";
            $conn->query($sql);
            echo "<p>Usuario registrado con exito!</p>";
        } else {
            echo "<p>Ya existe un usuario con ese correo!</p>";
        }
        $conn->close();
    }
}

?>