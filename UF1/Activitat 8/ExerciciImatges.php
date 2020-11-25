<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imagenes</title>
</head>
<body>
<?php
    include "funcions.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_REQUEST["volver"])) {
            header("Location: ExerciciPrivat.php");
        }

        if (isset($_REQUEST["subir"])) {
            subir_imagen($_REQUEST["idprod"]);
        }

        if (isset($_REQUEST["borrar"])) {
            borrar_imagen($_REQUEST["idimg"], $_REQUEST["ruta"]);
        }

        if (isset($_REQUEST["ancategoria"])) {
            comprovar_existe_categoria($_REQUEST["idprod"], $_REQUEST["categoria"]);
        }

        if (isset($_REQUEST["borrcat"])) {
            borrar_categoria_producto($_REQUEST["idcat"]);
        }
?>
<form method="post">
    <h3>Volver a tu pagina: <button type="submit" name="volver" value="Si">Volver</button></h3>
</form>
<table border="1">
    <form enctype="multipart/form-data" method="post">
        <tr>
            <td><label>Subir una foto: </label></td>
    <?php
        echo "<input type='hidden' name='idprod' value='".$_REQUEST["idprod"]."'>";
    ?>      
            <td><input type="file" name="myfile" accept="image/x-png,image/gif,image/jpeg"></td>
            <td><button type="submit" name="subir" value="si">Subir imagen</button></td>
        </tr>
    </form>
</table><br>
</form>
<table border="1">
    <form method="post">
        <tr>
            <td><label>Añadir categoria: </label></td>
    <?php
        echo "<input type='hidden' name='idprod' value='".$_REQUEST["idprod"]."'>";
    ?>      
            <td><input type="text" name="categoria"></td>
            <td><button type="submit" name="ancategoria" value="si">Añadir categoria</button></td>
        </tr>
    </form>
</table><br>
<h2>Categorias del producto:</h2>
<?php
        ver_categorias_usuario($_REQUEST["idprod"]);
?> 
<br><h2>Imagenes del producto:</h2>
<?php
        tabla_imagenes_usuario($_REQUEST["idprod"]);
    } else {
        header("Location: ExerciciPrivat.php");
    }
?>
</body>
</html>