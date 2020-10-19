<?php
    session_start();

    if (isset($_SESSION["user"]) && isset($_SESSION["password"])) {
        echo "<p>Hola ".$_SESSION["user"]."!</p>";
        
    } else {
        header("Location: UF1-A4-ExerciciPublic.php");
    }

?>