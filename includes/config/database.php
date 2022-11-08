<?php

function conectarDB() : mysqli{
    $db = mysqli_connect('localhost', 'root', 'root', 'bienes_raices');

    if(!$db){
        echo "Error: No se estableció conexión con la base de datos";
        exit;
    }
    
    return $db;
}