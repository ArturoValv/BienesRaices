<?php

namespace App;

class Propiedad extends ActiveRecord
{
    protected static $tabla = 'propiedades';
    protected static $columnasBD = [
        'id', 'titulo', 'precio', 'imagen',
        'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'
    ];

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
}
