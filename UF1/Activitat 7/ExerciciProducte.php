<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion del producto</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["volver"])) {
            header("Location: ExerciciPublic.php");
        }

        if (isset($_REQUEST["volvercarr"])) {
            header("Location: ExerciciCarrito.php");
        }

        if (isset($_REQUEST["afegir"])) {
            afegir_carrito($_REQUEST["idprod"]);
        }

    if (isset($_REQUEST["info"])  && $_REQUEST["info"] == "public") {
?>
<form method="post">
    <h3>Volver a la pagina principal: <button type="submit" name="volver" value="public">Menu</button></h3>
</form>
<?php
    }

    if (isset($_REQUEST["info"])  && $_REQUEST["info"] == "carrito") {
?>
<form method="post">
    <h3>Volver al carrito: <button type="submit" name="volvercarr" value="carrito">Menu</button></h3>
</form>
<?php
    }

    if (isset($_SESSION["user"]) && comprovar_vendido($_REQUEST["idprod"])) {
        echo "<form method='post'>
            <input type='hidden' name='idprod' value='".$_REQUEST["idprod"]."'>";
?>
    <h3>Añadir al carrito: <button type="submit" name="afegir" value="Si">Añadir</button></h3>
</form><br>
<?php
    } else {
        echo "<h3>Este producto ya se ha vendido!</h3><br>";
    }

        informacion_producto($_REQUEST["idprod"]);
?>
<h3>Categorias:</h3>
<?php
        ver_categorias($_REQUEST["idprod"]);
?>
<br><h3>Imagenes del producto:</h3>
<?php
        tabla_imagenes($_REQUEST["idprod"]);
    } else {
        header("Location: ExerciciPublic.php");
    }
?>
</body>
</html>