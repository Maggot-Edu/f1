<?php


    require_once "config/functions.php";
    require_once "config/config.php";
    require_once "includes/cabecera.php";
    $titulo = "Añadir Piloto Nuevo";
    
    session_start();

    control_cabecera_usuarios_logueados($titulo);

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-sm-3">
            <h2>About Me</h2>
            <h5>Photo of me:</h5>
            <div class="fakeimg">Fake Image</div>
            <p>Some text about me in culpa qui officia deserunt mollit anim..</p>
            <h3 class="mt-4">Some Links</h3>
            <p>Lorem ipsum dolor sit ame.</p>
            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="#">Active</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
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
            <h2>Añadir nuevo piloto</h2>
            <p>Para añadir nuevo piloto debe rellenar el siguiente formulario con los datos del Piloto.</p>
            <br>
            <form action="config/insert_piloto.php" method="post">
                <p>
                    <!--<label for="NombrePiloto">Nombre del Piloto:</label>-->
                    <input type="text" class="form-control mt-3" name="NombrePiloto" placeholder="Nombre Piloto">
                </p>
                <p>
                    <!--<label for="FechaNaci">Fecha nacimiento:</label>-->
                    <input type="date" class="form-control mt-3" name="FechaNaci">
                </p>
                <p>
                    <!--<label for="Edad">Edad del piloto:</label>-->
                    <input type="number" class="form-control mt-3" placeholder="Edad" name="Edad">
                </p>
                <p>
                    <!--<label for="LugarNaci">Lugar de nacimiento:</label>-->
                    <input type="text" class="form-control mt-3" placeholder="Lugar de nacimiento" name="LugarNaci">
                </p>
                <p>
                    <!--<label for="Nacionalidad">Nacionalidad:</label>-->
                    <input type="text" class="form-control mt-3" placeholder="Nacionalidad" name="Nacionalidad">
                </p>
                <p>
                    <!--<label for="Nacionalidad">Instagram del piloto:</label>-->
                    <input type="text" class="form-control mt-3" placeholder="Url del instagram" name="Instagram">
                </p>
                <p>
                    <!--<label for="Nacionalidad">Twitter del piloto:</label>-->
                    <input type="text" class="form-control mt-3" placeholder="Url del Twitter" name="Twitter">
                </p>
                <p>
                    <input type="text" class="form-control mt-3" name="FotoPiloto">
                </p>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </div>
</div>

<?php
    require_once "includes/footer.php";
?>