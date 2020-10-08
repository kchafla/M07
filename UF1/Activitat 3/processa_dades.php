<?php

    echo "En el campo de texto has escrito: $_REQUEST[mytext]<br/><br/>";

    if( isset($_REQUEST['myradio']) ) {
        echo "Has seleccionado el valor del radio: $_REQUEST[myradio]<br/><br/>";
    }

    if( isset($_REQUEST['mycheckbox']) ) {
        foreach( $_REQUEST['mycheckbox'] as $valor ){
            echo "Has marcado el valor de la casilla: $valor<br/>";
        }
        echo "<br/>";
    }

    if( isset($_REQUEST['myselect']) ) {
        echo "Has seleccionado el valor: $_REQUEST[myselect]<br/><br/>";
    }

    echo "En el area de texto has escrito: $_REQUEST[mytextarea]<br/><br/>";

    $dir_subida = 'imagenes/';
    $fichero_subido = $dir_subida.basename($_FILES['myfile']['name']);
    if (move_uploaded_file($_FILES['myfile']['tmp_name'], $fichero_subido)) {
        echo "La imagen se ha subido correctamente.<br/>";
        echo "<img src=\"imagenes/".$_FILES['myfile']['name']."\"/>";
    } else {
        echo "No se ha podido subir la imagen.";
    }

?>