<?php
    
    require_once "config.php";


    $sql = "INSERT INTO pilotos (NombrePiloto,FechaNaciPiloto,EdadPiloto,LugarNaciPiloto,NacionalidadPiloto,InstaPiloto,TwitterPiloto,FotoPiloto) VALUES (?,?,?,?,?,?,?,?)";

    if ($stmt = mysqli_prepare($conexion, $sql)) {
        
        mysqli_stmt_bind_param($stmt, "ssisssss", $NombrePiloto, $FechaNaciPiloto, $EdadPiloto, $LugarNaciPiloto, $NacionalidadPiloto, $InstaPiloto, $TwitterPiloto, $FotoPiloto);

        $NombrePiloto =         $_REQUEST['NombrePiloto'];
        $FechaNaciPiloto =      $_REQUEST['FechaNaci'];
        $EdadPiloto =           $_REQUEST['Edad'];
        $LugarNaciPiloto =      $_REQUEST['LugarNaci'];
        $NacionalidadPiloto =   $_REQUEST['Nacionalidad'];
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


