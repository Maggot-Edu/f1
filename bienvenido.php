<?php

    require_once "config/functions.php";
    $titulo = "Bienvenido";
    require_once "includes/cabecera.php";
    session_start();
    // berificamos si el usuario esta logueado
    control_cabecera_usuarios_logueados($titulo);

?>

<div class="container mt-5">
    <div class="row">
        <?php 
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                if ($_SESSION["perfil"] == "admin") {
                    require_once "includes/perfil_admin.php";
                }
            } else {
                    require_once "includes/perfil_user.php";
            }
         ?>
        <div class="col-sm-9">
            <h2>Hola, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Bienvenido a la APP F1.</h2>
            <h5>Title description, Dec 7, 2020</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>    
            <h2 class="mt-5">TITLE HEADING</h2>
            <h5>Title description, Sep 2, 2020</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text..</p>
            <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
        </div>
    </div>
</div>
<?php
    require_once "includes/footer.php";
?>