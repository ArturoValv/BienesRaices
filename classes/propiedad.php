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

        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? null;
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function guardar()
    {
        if (!is_null($this->id)) {
            //Actualizar
            $this->actualizar();
        } else {
            //Creando nuevo registro
            $this->crear();
        }
    }

    public function crear()
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

        if ($resultado) {
            //Redireccionar al usuario
            header("Location: /admin?resultado=1");
        }
    }

    public function actualizar()
    {
        //Sanitizar datos
        $atributos = $this->sanitizarAtributos();
        $valores = [];
        foreach ($atributos as $key => $value) {
            //Redireccionar al usuario
            $valores[] = "{$key} = '{$value}'";
        }

        $query = " UPDATE propiedades SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            //Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
    }

    //Eliminar un registro
    public function eliminar()
    {
        //Eliminar la Propiedad
        $query = "DELETE FROM propiedades WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            //Redireccionar al usuario
            header("Location: /admin?resultado=3");
        }
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

    //Subida de Archivos
    public function setImagen($imagen)
    {
        //Eliminar imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        //Asignar al atributo de imagen el nombre de la imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }

    //Eliminar Archivo
    public function borrarImagen()
    {
        //Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETAS_IMAGENES . $this->imagen);

        if ($existeArchivo) {
            unlink(CARPETAS_IMAGENES . $this->imagen);
        }
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

        if (!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        }

        return self::$errores;
    }

    //Listar todos las registros
    public static function all()
    {
        $query = "SELECT * FROM propiedades";

        $resultado = self::consultaSQL($query);

        return $resultado;
    }

    //Busca un registro por su id
    public static function find($id)
    {
        $query = "SELECT * FROM propiedades WHERE id = ${id}";
        $resultado = self::consultaSQL($query);
        return array_shift($resultado);
    }

    public static function consultaSQL($query)
    {
        //Consultar la BD
        $resultado = self::$db->query($query);

        //Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = self::crearObjeto($registro);
        }

        //Liberar la memoria
        $resultado->free();

        //Retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new self;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto;
    }

    //Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
