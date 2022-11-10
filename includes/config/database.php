<?php

function conectarDB(): mysqli
{
    $db = new mysqli('localhost', 'root', 'root', 'bienes_raices');

    if (!$db) {
        echo "Error: No se estableció conexión con la base de datos";
        exit;
    }

    return $db;
}
