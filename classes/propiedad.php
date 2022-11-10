<?php

namespace App;

class Propiedad
{
    //Base de Datos
    protected static $db;
    protected static $columnasBD = [
        'id', 'titulo', 'precio', 'imagen',
        'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'
    ];

    //Errores
    protected static $errores = [];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    //Definir la conexión a la BD

    public static function setDB($database)
    {
        self::$db = $database;
    }

    public function __construct($args = [])
    {

        $this->id = $args['id'] ?? '';
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? 'imagen.jpg';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar()
    {
        //Sanitizar datos
        $atributos = $this->sanitizarAtributos();

        //Insertar los datos en la BD
        $query = "INSERT INTO propiedades (";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        $resultado = self::$db->query($query);

        debugear($resultado);
    }

    //Identificar y unir los atributos de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (self::$columnasBD as $columna) {
            if ($columna === 'id') continue;

            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }


    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    //Validacion
    public static function getErrores()
    {
        return self::$errores;
    }

    public function validar()
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título";
        }

        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }

        if (!$this->descripcion) {
            self::$errores[] = "Debes añadir una descripción";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir una habitación";
        }

        if (!$this->wc) {
            self::$errores[] = "Debes añadir un baño";
        }

        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir un estacionamiento";
        }

        if (!$this->vendedorId || !is_numeric($this->vendedorId)) {
            self::$errores[] = "Elige un vendedor";
        }

        /* if (!$this->imagen['name'] || $this->imagen['error']) {
            self::$errores[] = 'La imagen es obligatoria';
        } */

        //Validar por tamaño

        /* $medida = 1000 * 1000;

        if ($this->imagen['size'] > $medida) {
            self::$errores[] = 'La imagen es muy pesada.';
        } */

        return self::$errores;
    }
}
