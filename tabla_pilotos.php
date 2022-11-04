<?php

    session_start();

    $titulo = "Nombre de la pagina";
    require_once "includes/cabecera.php";
    // Comprobamos si esta logueado o no
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        if ($_SESSION["perfil"] == "admin") {
            require_once "includes/menu_admin.php";
        } else {
            require_once "includes/menu_user.php";
        }
    } else {
        require_once "includes/menu.php";
    }
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            
        </div>
    </div>
</div>
<?php
    require_once "includes/footer.php";
?>