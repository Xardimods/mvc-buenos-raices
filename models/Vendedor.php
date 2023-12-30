<?php
declare(strict_types = 1);
namespace Model; 

class Vendedor extends ActiveRecord {

    protected static $tabla = "vendedores";
    protected static $columnasBBDD = ["id", "nombre", "apellido", "telefono"];
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->nombre = $args["nombre"] ?? "";
        $this->apellido = $args["apellido"] ?? "";
        $this->telefono = $args["telefono"] ?? "";
    }

    public function validarInputs () : array {
        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un nombre"; 
        }
        if (!$this->apellido) {
            self::$errores[] = "Debes añadir un apellido"; 
        }
        if (!$this->telefono) {
            self::$errores[] = "Debes añadir un número de teléfono"; 
        }

        if (!preg_match("/[0-9]{10}/", $this->telefono)) {
            self::$errores[] = "El formato no es válido"; 
        }

        return self::$errores;
    }
}