<?php

header('Content-Type: application/json');

require_once "config/config.php";


switch ($_GET['action']) {
    case 'mostrar':
        $datos = mysqli_query($conexion, 'SELECT * FROM pilotos');
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
    case 'insertar':
        $respuesta = mysqli_query($conexion, 'INSERT INTO pilotos(NomCorto,NombrePiloto,FechaNaciPiloto,EdadPiloto,LugarNaciPiloto,NacionalidadPiloto,InfoPiloto,InstaPiloto,TwitterPiloto,FotoPiloto) 
                                              VALUES ("$_POST[NomCorto],$_POST[NombrePiloto],$_POST[FechaNaciPiloto],$_POST[EdadPiloto],$_POST[LugarNaciPiloto],$_POST[NacionalidadPiloto],$_POST[InfoPiloto],$_POST[InstaPiloto],$_POST[TwitterPiloto],$_POST[FotoPiloto],")');
        echo json_encode($respuesta);
        break;
    case 'borrar':
        $respuesta = mysqli_query($conexion, 'DELETE FROM pilotos 
                                              WHERE IdPiloto=$_GET[IdPiloto]');
        echo json_encode($respuesta);
        break;
    case 'consultar':
        $datos = mysqli_query($conexion, 'SELECT NombrePiloto,FechaNaciPiloto,EdadPiloto,NacionalidadPiloto 
                                          FROM pilotos 
                                          WHERE IdPiloto=$_GET[IdPiloto]');
        $resultado = mysqli_fetch_all($datos, MYSQLI_ASSOC);
        echo json_encode($resultado);
        break;
    case 'modificar':
        $respuesta = mysqli_query($conexion, 'UPDATE pilotos 
                                              SET
                                              NombrePiloto="$_POST[NombrePiloto]",
                                              FechaNaciPiloto="$_POST[FechaNaciPiloto]",
                                              InfoPiloto="$_POST[InfoPiloto]"
                                              WHERE IdPiloto=$_GET[IdPiloto]');
        echo json_encode($respuesta);
        break;
}








?>