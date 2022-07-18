<?php


    session_start();

    // desmotamos todas las variables de la sesion
    $_SESSION = array();

    // Rompemos la sesion
    session_destroy();

    // redirigimos a pagina de login
    header("location: login.php");

    exit;