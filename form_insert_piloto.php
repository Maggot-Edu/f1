<?php

    $titulo = "Añadir Piloto Nuevo";
    require_once "config/functions.php";
    require_once "config/config.php";
    require_once "includes/cabecera.php";
    
    
    session_start();

    control_cabecera_usuarios_logueados($titulo);


/////////////////////////////test//////////////////////////////////
$NombrePiloto = $NombrePiloto_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST['NombrePiloto']))) {
        $NombrePiloto_err = "Ingrese nombre y apellido del piloto";
    } //elseif (!preg_match('/^[a-zA-Z]+$/', trim($_POST["NombrePiloto"]))){
       // $NombrePiloto_err = "Nombre de piloto solo puede contener letras";
    //} 
    else {

        $consulta = "SELECT IdPiloto FROM `pilotos` WHERE NombrePiloto = ?";

        if ($stmt = mysqli_prepare($conexion, $consulta)) {
            mysqli_stmt_bind_param($stmt, "s" , $param_NombrePiloto);

            $param_NombrePiloto = trim($_POST['NombrePiloto']);

            if (mysqli_stmt_execute($stmt)) {

                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $NombrePiloto_err = "Este Piloto ya esta registrado en la Base de Datos";
                } else {
                    $NombrePiloto = trim($_POST['NombrePiloto']);
                }
            } else {
                echo "¡Anda! Ha pasado algo raro. Intentalo de nuevo.";
            }
        }
        mysqli_stmt_close($stmt);

    }

    if (empty($NombrePiloto_err)) {

        $sql = "INSERT INTO pilotos (NombrePiloto,FechaNaciPiloto,EdadPiloto,LugarNaciPiloto,NacionalidadPiloto,InfoPiloto,InstaPiloto,TwitterPiloto,FotoPiloto) VALUES (?,?,?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($conexion, $sql)) {
            
            mysqli_stmt_bind_param($stmt, "ssissssss", $NombrePiloto, $FechaNaciPiloto, $EdadPiloto, $LugarNaciPiloto, $NacionalidadPiloto,$InfoPiloto, $InstaPiloto, $TwitterPiloto, $FotoPiloto);
    
            $NombrePiloto =         $_REQUEST['NombrePiloto'];
            $FechaNaciPiloto =      $_REQUEST['FechaNaci'];
            $EdadPiloto =           $_REQUEST['Edad'];
            $LugarNaciPiloto =      $_REQUEST['LugarNaci'];
            $NacionalidadPiloto =   $_REQUEST['Nacionalidad'];
            $InfoPiloto =           $_REQUEST['InfoPiloto'];
            $InstaPiloto =          $_REQUEST['Instagram'];
            $TwitterPiloto =        $_REQUEST['Twitter'];
            $FotoPiloto =           $_REQUEST['FotoPiloto'];
    
            if(mysqli_stmt_execute($stmt)){
                echo "Se ha añadido el nuevo piloto.";
            } else {
                echo "Error: no se ha podido ejecutar la consulta: $sql. " . mysqli_error($conexion);
            }
        } else {
            echo "Error: no se ha podido ejecutar la consulta: $sql. " . mysqli_error($conexion);
        }
    
        mysqli_stmt_close($stmt);
    
        mysqli_close($conexion);
    }

}
/////////////////////////////test//////////////////////////////////
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <p>
                    <!--<label for="NombrePiloto">Nombre del Piloto:</label>-->
                    <input type="text" class="form-control mt-3 <?php echo (!empty($NombrePiloto_err)) ? 'is-invalid' : ''; ?>" name="NombrePiloto" placeholder="Nombre Piloto (Nombre Apellido)" value="<?php echo $NombrePiloto; ?>">
                    <span class="invalid-feedback"><?php echo $NombrePiloto_err; ?></span>
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
                <div class="form-group">
                    <label for="InfoPiloto">Información breve del piloto</label>
                    <textarea name="InfoPiloto" id="InfoPiloto" class="form-control" rows="2"></textarea>
                </div>
                <p>
                    <!--<label for="Instagram">Instagram del piloto:</label>-->
                    <input type="text" class="form-control mt-3" placeholder="Url del instagram" name="Instagram">
                </p>
                <p>
                    <!--<label for="Twitter">Twitter del piloto:</label>-->
                    <input type="text" class="form-control mt-3" placeholder="Url del Twitter" name="Twitter">
                </p>
                <p>
                    <input type="text" class="form-control mt-3" name="FotoPiloto">
                </p>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                    <input type="reset" class="btn btn-secondary ml-2" value="Borrar">
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    require_once "includes/footer.php";
?>