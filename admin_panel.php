<?php

    require_once "config/functions.php";
    require_once "config/config.php";
    require_once "includes/cabecera.php";
    $titulo = "Panel de Administrador";
    
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
            <h2>Listado de todos los Usuarios Registrados</h2>
            <?php
                $query = "SELECT id, username, perfil, created_at FROM users";
                $todosUsuarios = $conexion->query($query);
            ?>
            <br>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre de Usuario</th>
                        <th>Perfil</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $todosUsuarios->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['perfil']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
    require_once "includes/footer.php";
?>