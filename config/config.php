<?php

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'f1');

    /*Conexion a BBDD */

    $conexion = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

    // Control de conexion

    if ( $conexion  === false) {
        die("ERROR: No se pudo conectar. " . mysqli_connect_error());
    }