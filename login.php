<?php
    // inicializar la sesion
    session_start();
    // Comp`robamos si esta logueado o no
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        
        header("location: bienvenido.php");
        exit;

    }

    require_once "config/config.php";

    // Definimos variables y las inicializamos
    $nombreUsuario = $contrasenya = "";
    $nombreUsuario_err = $contrasenya_err = $login_err = "";

    // Procesamos datos del formulario cuando se envian

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        // Comprobamos si el nombre de usuario esta vacio
        if (empty(trim($_POST["username"]))) {
            $nombreUsuario_err = "Ingrese un nombre de usuario";
        } else {
            $nombreUsuario = trim($_POST["username"]);
        }
        // Comprobamos si la contraseña de usuario esta vacio
        if (empty(trim($_POST["password"]))) {
            $contrasenya_err = "Ingrese una contraseña";
        } else {
            $contrasenya = trim($_POST["password"]);
        }


        if (empty($nombreUsuario_err) && empty($contrasenya_err)) {
            
            // Consulta select
            $sql = "SELECT id, username, password, perfil FROM users WHERE username = ?";

            if ($stmt = mysqli_prepare($conexion, $sql)) {
                // vinculamos variable a la declaracion como parametro
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                // Establecemos el parametro
                $param_username = $nombreUsuario;

                //Intento de ejecutar la declaración preparada
                if ( mysqli_stmt_execute($stmt) ) {
                    mysqli_stmt_store_result($stmt);

                    // Verificamos si el nmbre de usuario existe, si existe verificamos el password
                    if (mysqli_stmt_num_rows($stmt) == 1) {
                        // vincular variables de resultado
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $perfil);
                        if (mysqli_stmt_fetch($stmt)) {
                            if (password_verify($contrasenya, $hashed_password)) {
                                // Si la contraseña es correcta inicia una nueva sesion
                                session_start();

                                // almacenamos datos en variables de sesion
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"]  = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["perfil"] = $perfil;

                                // redirigimos a pagina de bienvenida
                                header("location: bienvenido.php");
                            } else {
                                // contraseña no coincide
                                $contrasenya_err = "Contraseña invalida.";
                            }
                        } 
                    } else {
                        // Usuario no existe
                        $login_err = "Usuario invalido o contraseña.";
                    }

                } else {
                    echo "¡Anda! ha pasado algo raro intenta de nuevo.";
                }

                // cerramos declaracion
                mysqli_stmt_close($stmt);
            }

        }

        // Cerramos conexion
        mysqli_close($conexion);

    }

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Iniciar sesión</title>
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
        <?php require_once "includes/menu.php"; ?>
        <div class="container">
            <div class="wrapper row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4"><br>
                    <h2>Iniciar session</h2>
                    <p>Por favor ingresa tus credenciales:</p>
                    <?php
                        if (!empty($login_err)) {
                            echo '<div class="alert alert-danger">'. $login_err .'</div>';
                        }
                    ?>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre de usuario:</label>
                            <input type="text" name="username" class="form-control <?php echo (!empty($nombreUsuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombreUsuario; ?>">
                            <span class="invalid-feedback"><?php echo $nombreUsuario_err; ?></span>
                        </div><br>
                        <div class="form-group">
                            <label>Contraseña: </label>
                            <input type="password" name="password" class="form-control <?php echo (!empty($contrasenya_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $contrasenya; ?>">
                            <span class="invalid-feedback"><?php echo $contrasenya_err; ?></span>
                        </div><br>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                        </div><br>
                        <p>¿Aun no tienes cuenta? <a href="registro.php">Registrate aquí</a>.</p>
                    </form> 
                </div>
                <div class="col-sm-4"></div>
            </div> 
        </div>
<?php
    require_once "includes/footer.php";
?>
