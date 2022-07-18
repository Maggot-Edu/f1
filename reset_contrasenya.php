<?php

    require_once "functions.php";
    session_start();
    $titulo = "Cambio de contraseña";

    // berificamos si el usuario esta logueado
    control_cabecera_usuarios_logueados($titulo);

    require_once "config/config.php";

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
<!-- <!DOCTYPE html>
<html lang="es">
    <head>
        <title>Cambiar contraseña</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <script src="assets/js/jquery-3.6.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="assets/css/styles.css">
    </head>
    <body>
        <a href="#" id="toTopBtn" class="cd-top text-replace js-cd-top cd-top--is-visible cd-top--fade-out" data-abc="true"></a>
        <div class="p-4 bg-light text-black text-center">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="250px" height="auto" viewBox="0 0 120 30" version="1.1" class="injected-svg js-svg-inject">
                            <defs>
                                <path d="M101.086812,30 L101.711812,30 L101.711812,27.106875 L101.722437,27.106875 L102.761812,30 L103.302437,30 L104.341812,27.106875 L104.352437,27.106875 L104.352437,30 L104.977437,30 L104.977437,26.25125 L104.063687,26.25125 L103.055562,29.18625 L103.044937,29.18625 L102.011187,26.25125 L101.086812,26.25125 L101.086812,30 Z M97.6274375,26.818125 L98.8136875,26.818125 L98.8136875,30 L99.4699375,30 L99.4699375,26.818125 L100.661812,26.818125 L100.661812,26.25125 L97.6274375,26.25125 L97.6274375,26.818125 Z M89.9999375,30 L119.999937,0 L101.943687,0 L71.9443125,30 L89.9999375,30 Z M85.6986875,13.065 L49.3818125,13.065 C38.3136875,13.065 36.3768125,13.651875 31.6361875,18.3925 C27.2024375,22.82625 20.0005625,30 20.0005625,30 L35.7324375,30 L39.4855625,26.246875 C41.9530625,23.779375 43.2255625,23.52375 48.4068125,23.52375 L75.2405625,23.52375 L85.6986875,13.065 Z M31.1518125,16.253125 C27.8774375,19.3425 20.7530625,26.263125 16.9130625,30 L-6.25e-05,30 C-6.25e-05,30 13.5524375,16.486875 21.0849375,9.0725 C28.8455625,1.685 32.7143125,0 46.9486875,0 L98.7643125,0 L87.5449375,11.21875 L48.0011875,11.21875 C37.9993125,11.21875 35.7518125,11.911875 31.1518125,16.253125 Z" id="path-1"></path>
                            </defs>
                            <g id="Logos-/-F1-logo-red" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="Page-1">
                                    <mask id="mask-2" fill="white">
                                        <use xlink:href="#path-1"></use>
                                    </mask>
                                    <use id="Fill-1" fill="#EE0000" xlink:href="#path-1"></use>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <div class="col-sm-7">
                        <h1>Base de Datos de la Formula1</h1>
                        <p>¡Base de datos no oficial!</p> 
                    </div>
                </div>
            </div>
        </div>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavbar">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="bienvenido.php">Perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Cerrar sesión</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->
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
        <div class="mt-5 p-4 bg-dark text-white text-center">
            <p>Footer</p>
        </div>

    </body>
</html>