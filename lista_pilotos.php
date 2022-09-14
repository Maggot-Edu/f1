<?php

    require_once "config/config.php";
    session_start();

    $titulo = "Pilotos";
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

    $consulta = "SELECT NombrePiloto, FotoPiloto, InfoPiloto FROM pilotos";
    $todosPilotos = array();
    $todosPilotos = $conexion->query($consulta);

    //var_dump($todosPilotos);
   // var_dump($todosPilotos->fetch_all());


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
                    <a class="nav-link active" href="#">Active</a>
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
            <h2>Pilotos F1</h2>
            <br>
            <div class="row">
            <?php while ($row = $todosPilotos->fetch_assoc()) { ?>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                      <img src="assets/images/<?php echo $row['FotoPiloto'] ?>" class="card-img-top" alt="">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row['NombrePiloto'] ?></h5>
                        <p class="card-text"><?php echo $row['InfoPiloto'] ?></p>
                        <a href="#" class="btn btn-primary">Ver Piloto</a>
                      </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once "includes/footer.php";
?>