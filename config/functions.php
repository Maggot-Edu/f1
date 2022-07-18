<?php

function control_cabecera_usuarios_logueados ($titulo) {

    if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
    } elseif ($_SESSION["perfil"] == "admin") {
        require_once "includes/cabecera_admin.php";
    } else {
        require_once "includes/cabecera_user.php";
    }

}

?>