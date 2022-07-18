<?php

    require_once "config/functions.php";
    $titulo = "Bienvenido";

    session_start();
    // berificamos si el usuario esta logueado
    control_cabecera_usuarios_logueados($titulo);

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <h2>Mi perfil</h2>
            <h5>Avatar:</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Cosas chulas sobre el usuario</p>
            <h3 class="mt-4">Acciones</h3>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a href="reset_contrasenya.php" class="nav-link" href="#">Cambia tu contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <hr class="d-sm-none">
        </div>
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