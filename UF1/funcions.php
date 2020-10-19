<?php

function comprovar_campo($campo) {
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function comprovar_email($email) {
    $email = test_input($email);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = true;
    } else {
        $emailError = false;
    }
    return $emailError;
}

function comprovar_contra($contra) {
    $contra = test_input($contra);
    if (!preg_match("/[a-zA-Z0-9]*/",$contra)) {
        $contraError = true;
    } else {
        $contraError = false;
    }
    return $contraError;
}

?>