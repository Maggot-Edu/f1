<?php
header('Content-Type: application/json');

require_once "config/config.php";


switch ($_GET['accion']) {
    case 'listar':
        $datos = mysqli_query($conexion, "SELECT IdPiloto,NombrePiloto,LugarNaciPiloto,NacionalidadPiloto,InfoPiloto 
                                          FROM pilotos");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        $nuevo_resultado = array("data"=>$resultado);
        echo json_encode($nuevo_resultado);
        break;

    case 'agregar':
        $respuesta = mysqli_query($conexion, "INSERT INTO pilotos(IdPiloto,NombrePiloto,LugarNaciPiloto,NacionalidadPiloto,InfoPiloto) 
                                              VALUES ('$_POST[IdPiloto]',$_POST[NombrePiloto]),$_POST[LugarNaciPiloto]),$_POST[NacionalidadPiloto]),$_POST[InfoPiloto])");
        echo json_encode($respuesta);
        break;

    case 'borrar':
        $respuesta = mysqli_query($conexion, "DELETE FROM pilotos 
                                              WHERE IdPiloto=$_GET[IdPiloto]");
        echo json_encode($respuesta);
        break;

    case 'consultar':
        $datos = mysqli_query($conexion, "SELECT IdPiloto,NombrePiloto,LugarNaciPiloto,NacionalidadPiloto,InfoPiloto 
                                          FROM pilotos 
                                          WHERE IdPiloto=$_GET[IdPiloto]");
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;

    case 'modificar':
        $respuesta = mysqli_query($conexion, "UPDATE pilotos SET
                                                     IdPiloto='$_POST[IdPiloto]',
                                                     NombrePiloto=$_POST[NombrePiloto],
                                                     LugarNaciPiloto=$_POST[LugarNaciPiloto],
                                                     NacionalidadPiloto=$_POST[NacionalidadPiloto],
                                                     InfoPiloto=$_POST[InfoPiloto],
                                               WHERE IdPiloto=$_GET[IdPiloto]");
        echo json_encode($respuesta);
        break;
}