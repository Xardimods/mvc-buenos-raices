<?php
declare(strict_types = 1);

namespace Model; 

class Propiedad extends ActiveRecord {
    
    protected static $tabla = "propiedades";
    protected static $columnasBBDD = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamientos", "creado", "vendedores_id"];

    public $id; 
    public $titulo; 
    public $precio; 
    public $imagen; 
    public $descripcion; 
    public $habitaciones; 
    public $wc; 
    public $estacionamientos; 
    public $creado;
    public $vendedores_id;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->precio = $args["precio"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->descripcion = $args["descripcion"] ?? "";
        $this->habitaciones = $args["habitaciones"] ?? "";
        $this->wc = $args["wc"] ?? "";
        $this->estacionamientos = $args["estacionamientos"] ?? "";
        $this->creado = date("Y/m/d");
        $this->vendedores_id = $args["vendedores_id"] ?? "";
    }

    public function validarInputs () : array {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título"; 
        }

        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio"; 
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "Debes añadir una descripción y debe de tener al menos 50 caracteres"; 
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir una cantidad de habitaciones"; 
        }

        if (!$this->wc) {
            self::$errores[] = "Debes añadir una cantidad de baños"; 
        }

        if (!$this->estacionamientos) {
            self::$errores[] = "Debes añadir una cantidad de estacionamientos"; 
        }
        if (!$this->vendedores_id) {
            self::$errores[] = "Debes elegir a tu vendedor o vendedora"; 
        }

        if (!$this->imagen) {
            self::$errores[] = "Debes seleccionar una imagen"; 
        }

        return self::$errores;
    }

}