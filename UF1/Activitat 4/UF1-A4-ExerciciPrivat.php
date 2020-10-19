<?php

    session_start();

    if (isset($_SESSION["user"])) {
        echo "hola.";
    } else {
        header("Location: UF1-A4-ExerciciPublic.php");
    }

?>