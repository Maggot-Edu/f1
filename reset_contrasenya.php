<?php
    session_start();
    $titulo = "Cambio de contraseña";
    require_once "config/functions.php";
    require_once "config/config.php";
    require_once "includes/cabecera.php";


    // berificamos si el usuario esta logueado
    control_cabecera_usuarios_logueados($titulo);



    // Definimos variables y sincronizamos
    $nuevaContrasenya = $confirmaNuevaContraseña = "";
    $nuevaContrasenya_err = $confirmaNuevaContraseña_err = "";

    // Procesamos datos enviados por formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Validar nueva conrtraseña
        if (empty(trim($_POST["nuevaContrasenya"]))) {
            $nuevaContrasenya_err = "Ingrese nueva contraseña.";
        } elseif (strlen(trim($_POST["nuevaContrasenya"])) < 6) {
            $nuevaContrasenya_err = "La contraseña debe tener al menos 6 caracteres.";
        } else {
            $nuevaContrasenya = trim($_POST["nuevaContrasenya"]);
        }

        // Validar confirmacion de contraseña
        if (empty(trim($_POST["confirmaNuevaContraseña"]))) {
            $confirmaNuevaContraseña_err = "Porfavor confirme la contraseña.";
        } else {
            $confirmaNuevaContraseña = trim($_POST["confirmaNuevaContraseña"]);
            if (empty($nuevaContrasenya_err) && ($nuevaContrasenya != $confirmaNuevaContraseña)) {
                $confirmaNuevaContraseña_err = "La contraseña no coincide.";
            }
        }

        // Verificamos errores antes de actualizar la BBDD
        if (empty($nuevaContrasenya_err) && empty($confirmaNuevaContraseña_err)) {
            //Consulta de actualizacion BBDD
            $sql = "UPDATE users SET password = ? WHERE id = ?";

            if ($stmt = mysqli_prepare($conexion, $sql)) {
                // Vinculamos variables a la declaracion preparada como parametros
                mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
                // Establecemos parametros
                $param_password = password_hash($nuevaContrasenya, PASSWORD_DEFAULT);
                $param_id = $_SESSION["id"];
                // Intento de ejecucion de la consulta
                if (mysqli_stmt_execute($stmt)) {
                    // Actualizacion de la contraseña y cierre de sesion. redireccion a login
                    session_destroy();
                    header("location: login.php");
                    exit();
                } else {
                    echo "¡Anda! ha pasado algo raro intenta de nuevo.";
                }

                // cerramos declaracion
                mysqli_stmt_close($stmt);
            }
        }

        // cerramos conexion
        mysqli_close($conexion);

    }
?>

<div class="container">
    <div class="wrapper row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <br>
            <h2>Cambiar contraseña</h2>
            <p>Rellena el formulari para actualizar la contraseña.</p>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>Nueva Contraseña:</label>
                    <input type="password" name="nuevaContrasenya" class="form-control <?php echo (!empty($nuevaContrasenya_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nuevaContrasenya; ?>">
                    <span class="invalid-feedback"><?php echo $nuevaContrasenya_err; ?></span>
                </div><br>
                <div class="form-group">
                    <label>Confirma la Contraseña:</label>
                    <input type="password" name="confirmaNuevaContraseña" class="form-control <?php echo (!empty($confirmaNuevaContraseña_err)) ? 'is-invalid' : ''; ?>">
                    <span class="invalid-feedback"><?php echo $confirmaNuevaContraseña_err; ?></span>
                </div><br>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                    <a class="btn btn-danger ml-2" href="bienvenido.php">Cancelar</a>
                </div>
            </form>
        </div>
        <div class="col-sm-4"></div>
    </div> 
</div>
<?php
    require_once "includes/footer.php";
?>