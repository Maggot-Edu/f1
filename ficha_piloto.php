<?php

    require_once "config/config.php";
    session_start();

    $titulo = $_GET["nombre"];
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
    //loltest
?>

<h1>
    <?php echo $_GET["piloto"]; ?>
</h1>
<?php
    require_once "includes/footer.php";
?>