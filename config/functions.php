<?php

function control_cabecera_usuarios_logueados ($titulo) {

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    } elseif (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["perfil"] === "admin") {
        require_once "includes/menu_admin.php";
    } else {
        require_once "includes/menu_user.php";
    }

    //echo $_SESSION["perfil"];
}

?>