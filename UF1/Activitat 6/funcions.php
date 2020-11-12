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
        header("Location: ExerciciPublic.php");
    } else {
        header("Location: https://www.google.es");
    }
}

function cerrar_session() {
    session_unset();
    session_regenerate_id();
    session_destroy();
    header("Location: ExerciciPublic.php");
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
            if ($usuario["role"] == 1) {
                header("Location: ExerciciPrivatAdmin.php");
            } else if ($usuario["role"] == 2) {
                header("Location: ExerciciPrivat.php");
            }
        } else {
            echo "<p>Datos incorrectos!</p>";
        }
    } else {
        echo "<p>Has escrito el correo/contraseña incorrectamente!</p>";
    }
}

function registrar_usuario($user, $password, $rol) {
    if (!comprovar_email($user)) {
        echo "<p>No has escrito el correo correctamente!</p>";
    } else if (!comprovar_contra($password)) {
        echo "<p>No has escrito la contraseña correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
        
        $sql = "SELECT * FROM Usuarios WHERE user='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "INSERT INTO Usuarios VALUES (NULL,'$user','$password',$rol)";
            if ($conn->query($sql) === TRUE) {
                echo "<p>Usuario registrado con exito!</p>";
            } else {
                echo "Error: ".$sql."<br>".$conn->error;
            }
        } else {
            echo "<p>Ya existe un usuario con ese correo!</p>";
        }
        $conn->close();
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

        $sql = "SELECT user FROM Usuarios WHERE user='$newuser'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "SELECT * FROM Usuarios WHERE user='$user'";
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
        } else {
            echo "<p>Ya existe un usuario con ese correo!</p>";
        }
    }
}

function generar_tabla_admin() {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>CORREO</th><th>CONTRASEÑA</th><th>ROL</th></th><th colspan='2'>ACCION</th></tr>";
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");
    
    $nombres = Array();
    $rol = Array();
    $id = Array();

    $sql = "SELECT id, user, role FROM Usuarios";
    $result = $conn->query($sql);

    while($usuario = $result->fetch_assoc()) {
        $nombres[] = $usuario["user"];
        $rol[] = $usuario["role"];
        $id[] = $usuario["id"];
    }

    for ($n=0; $n < count($nombres); $n++) { 
        echo "<form method='post'>";
        echo "<tr>
            <td><input size='1' type='text' name='id' value='".$id[$n]."' readonly></td>
            <td><input type='text' name='newuser' value='".$nombres[$n]."'></td>
            <td><input type='password' name='newpassword'></td>";

                if ($n == 0) {
                    echo "<td><select name='newrol' disabled><option value='1' selected>Administrador</option><option value='2'>Usuario</option></select></td>";
                    echo "<input type='hidden' name='newrol' value='1' />";
                } else {
                    if ($rol[$n] == 1) {
                        echo "<td><select name='newrol'><option value='1' selected>Administrador</option><option value='2'>Usuario</option></select></td>";
                    } elseif ($rol[$n] == 2) {
                        echo "<td><select name='newrol'><option value='1'>Administrador</option><option value='2' selected>Usuario</option></select></td>";
                    }
                }

                if ($n == 0) {
                    echo "<td colspan='2' style='text-align: center;'><button type='submit' name='modificar' value='si'>Modificar</button></td>";
                } else if ($n != 0) {
                    echo "<td><button type='submit' name='modificar' value='si'>Modificar</button></td>
                        <td><button type='submit' name='borrar' value='si'>Eliminar</button></td>";
                }
        echo "</tr>";
        echo "</form>";
    }
    echo "</table><br>";

    echo "<h3>Crear usuario:</h3>";
    echo "<table border='1'>
            <form method='post'>
                <tr><th>CORREO</th><th>CONTRASEÑA</th><th>ROL</th></th><th>ACCION</th></tr>
                <td><input type='text' name='reguser'></td>
                <td><input type='password' name='regpassword'></td>
                <td><select name='regrol'><option value='1'>Administrador</option><option value='2' selected>Usuario</option></select></td>
                <td><button type='submit' name='crear' value='si'>Crear</button></td>
            </form>
        </table>";
}

function borrar_usuario($user) {
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "SELECT id FROM Usuarios WHERE user='$user'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
    $id = $usuario["id"];

    $sql = "DELETE FROM Usuarios WHERE id='$id'";
    $result = $conn->query($sql);
    $conn->close();

    echo "Usuario eliminado!";
}

function modificar_usuario_admin($id, $user, $password, $rol) {
    if (!comprovar_email($user)) {
        echo "<p>No has escrito el correo a modificar correctamente!</p>";
    } else if (empty($password)) {
        echo "<p>No has escrito la nueva contraseña!</p>";
    } else if (!comprovar_contra($password)) {
        echo "<p>No has escrito la nueva contraseña correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

        $sql = "SELECT user FROM Usuarios WHERE user='$user'";
        $result = $conn->query($sql);

        if ($result->num_rows == 0) {
            $sql = "UPDATE Usuarios SET user='$user' WHERE id=$id";
            $result = $conn->query($sql);
            $sql = "UPDATE Usuarios SET password='$password' WHERE id=$id";
            $result = $conn->query($sql);
            $sql = "UPDATE Usuarios SET role='$rol' WHERE id=$id";
            $result = $conn->query($sql);

            $conn->close();

            echo "Usuario actualizado!";
        } else {
            echo "Ya existe un usuario con ese correo!";
        }
    }
}

function subir_producto($nom, $descripcion, $precio, $usuario) {
    if ($nom == "") {
        echo "<p>No has escrito el nombre del producto!</p>";
    } else if ($descripcion == "") {
        echo "<p>No has escrito la descripcion!</p>";
    } else if ($precio == "") {
        echo "<p>No has escrito el precio!</p>";
    } else if (!is_numeric($precio)) {
        echo "<p>No has escrito el precio correctamente!</p>";
    } else {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

        $sql = "SELECT * FROM Usuarios WHERE user='$usuario'";
        $result = $conn->query($sql);
        $usuario = $result->fetch_assoc();
        $id = $usuario["id"];

        $sql = "INSERT INTO Productos VALUES (NULL,'$nom','$descripcion', $precio, $id)";

        if ($conn->query($sql) === TRUE) {
                echo "<p>Producto registrado con exito!</p>";
        } else {
                echo "Error: ".$sql."<br>".$conn->error;
        }

        $conn->close();
    }
}

function modificar_producto($id, $nom, $desc, $preu) {
    if (!is_numeric($preu)) {
        echo "<p>Para modificar el precio, escribe solo el numero (sin €)!</p>";
    } else {
        $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

        $sql = "UPDATE Productos SET nom='$nom' WHERE id=$id";
        $result = $conn->query($sql);
        $sql = "UPDATE Productos SET descripcio='$desc' WHERE id=$id";
        $result = $conn->query($sql);
        $sql = "UPDATE Productos SET preu='$preu' WHERE id=$id";
        $result = $conn->query($sql);

        $conn->close();
        echo "Producto actualizado!";
    }
}

function borrar_producto($id) {
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "DELETE FROM Productos WHERE id='$id'";
    $result = $conn->query($sql);
    $conn->close();

    echo "Producto eliminado!";
}

function tabla_productos_usuario($user) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>NOMBRE</th><th>DESCRIPCION</th><th>PRECIO</th><th colspan='2'>ACCION</th></tr>";
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "SELECT * FROM Usuarios WHERE user='$user'";
    $result = $conn->query($sql);
    $usuario = $result->fetch_assoc();
    $id = $usuario["id"];

    $sql = "SELECT * FROM Productos WHERE idusuari='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($producto = $result->fetch_assoc()) {
            $nombre[] = $producto["nom"];
            $desc[] = $producto["descripcio"];
            $precio[] = $producto["preu"];
            $ids[] = $producto["id"];
        }
    
        for ($n=0; $n < count($nombre); $n++) {
            echo "<form method='post'>";
            echo "<tr>
                <td><input size='1' type='text' name='idprod' value='".$ids[$n]."' readonly></td>
                <td><input type='text' name='nomprod' value='".$nombre[$n]."'></td>
                <td><textarea style='resize: none;' name='descprod' cols='60' rows='3'>".$desc[$n]."</textarea></td>
                <td><input type='text' name='preuprod' value='".$precio[$n]."€'></td>
                <td><button type='submit' name='modificarprod' value='si'>Modificar</button></td>
                <td><button type='submit' name='borrarprod' value='si'>Eliminar</button></td>";
            echo "</tr>";
            echo "</form>";
        }
    } else {
        echo "<tr><td colspan='5' style='text-align: center;'><p>No tienes ningun producto!</p></td></tr>";
    }
    
    echo "</table><br>";
}

function tabla_productos() {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>NOMBRE</th><th>DESCRIPCION</th><th>PRECIO</th><th>ACCION</th></tr>";
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "SELECT * FROM Productos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($producto = $result->fetch_assoc()) {
            $nombre[] = $producto["nom"];
            $desc[] = $producto["descripcio"];
            $precio[] = $producto["preu"];
            $ids[] = $producto["id"];
        }
    
        for ($n=0; $n < count($nombre); $n++) {
            echo "<form action='ExerciciProducte.php' method='post'>";
            echo "<tr>
                <td><input size='1' type='text' name='idprod' value='".$ids[$n]."' readonly></td>
                <td><input type='text' name='nomprod' value='".$nombre[$n]."' readonly></td>
                <td><textarea style='resize: none;' name='descprod' cols='60' rows='3' readonly>".$desc[$n]."</textarea></td>
                <td><input type='text' name='preuprod' value='".$precio[$n]."€' readonly></td>
                <td><button type='submit' name='info' value='Si'>Mas informacion</button></td>";
            echo "</tr>";
            echo "</form>";
        }
    } else {
        echo "<tr><td colspan='3' style='text-align: center;'><p>No hay productos registrados!</p></td></tr>";
    }
    
    echo "</table><br>";
}

function tabla_buscador($buscar) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>NOMBRE</th><th>DESCRIPCION</th><th>PRECIO</th><th>ACCION</th></tr>";
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "SELECT * FROM Productos WHERE LOWER(nom) LIKE '%{$buscar}%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($producto = $result->fetch_assoc()) {
            $nombre[] = $producto["nom"];
            $desc[] = $producto["descripcio"];
            $precio[] = $producto["preu"];
            $ids[] = $producto["id"];
        }
    
        for ($n=0; $n < count($nombre); $n++) {
            echo "<form action='ExerciciProducte.php' method='post'>";
            echo "<tr>
                <td><input size='1' type='text' name='idprod' value='".$ids[$n]."' readonly></td>
                <td><input type='text' name='nomprod' value='".$nombre[$n]."' readonly></td>
                <td><textarea style='resize: none;' name='descprod' cols='60' rows='3' readonly>".$desc[$n]."</textarea></td>
                <td><input type='text' name='preuprod' value='".$precio[$n]."€' readonly></td>
                <td><button type='submit' name='info' value='Si'>Mas informacion</button></td>";
            echo "</tr>";
            echo "</form>";
        }
    } else {
        echo "<tr><td colspan='3' style='text-align: center;'><p>No hay productos registrados!</p></td></tr>";
    }
    
    echo "</table><br>";
}

function informacion_producto($id) {
    echo "<table border='1'>";
    echo "<tr><th>NOMBRE</th><th>DESCRIPCION</th><th>PRECIO</th></tr>";
    $conn = new mysqli("localhost", "kchafla", "kchafla", "kchafla_Activitat05");

    $sql = "SELECT * FROM Productos WHERE id='$id'";
    $result = $conn->query($sql);

    while($producto = $result->fetch_assoc()) {
        $nombre[] = $producto["nom"];
        $desc[] = $producto["descripcio"];
        $precio[] = $producto["preu"];
        $ids[] = $producto["id"];
    }

    for ($n=0; $n < count($nombre); $n++) {
        echo "<form method='post'>";
        echo "<tr>
            <td><input type='text' name='nomprod' value='".$nombre[$n]."' readonly></td>
            <td><textarea style='resize: none;' name='descprod' cols='60' rows='3' readonly>".$desc[$n]."</textarea></td>
            <td><input type='text' name='preuprod' value='".$precio[$n]."€' readonly></td>";
        echo "</tr>";
        echo "</form>";
    }
    
    echo "</table><br>";
}
?>
