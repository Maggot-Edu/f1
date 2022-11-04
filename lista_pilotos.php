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

    $consulta = "SELECT IdPiloto, NombrePiloto, FotoPiloto, InfoPiloto FROM pilotos ORDER BY NombrePiloto ASC";
    $todosPilotos = array();
    $todosPilotos = $conexion->query($consulta);

    //var_dump($todosPilotos);
   // var_dump($todosPilotos->fetch_all());


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
                        <a href="fucha_piloto.php?piloto=<?php echo $row['IdPiloto'] ?>&nombre=<?php echo $row['NombrePiloto'] ?>" class="btn btn-primary" target="_blank">Ver Piloto</a>
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