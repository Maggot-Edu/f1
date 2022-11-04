<?php
    $titulo = "Panel de Administrador";
    require_once "config/functions.php";
    require_once "config/config.php";
    require_once "includes/cabecera.php";

    
    session_start();

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
            <h2>Listado de todos los Usuarios Registrados</h2>
            <?php
                $query = "SELECT id, username, perfil, created_at FROM users";
                $todosUsuarios = $conexion->query($query);
               // var_dump($todosUsuarios);
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