<?php
declare(strict_types = 1);

namespace Model; 

class Blogs extends ActiveRecord {

    protected static $tabla = "blogs";
    protected static $columnasBBDD = ["id", "titulo", "fecha", "autor", "texto", "imagen", "subtitulo"];

    public $id; 
    public $titulo; 
    public $fecha; 
    public $autor; 
    public $texto; 
    public $imagen; 
    public $subtitulo; 

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->titulo = $args["titulo"] ?? "";
        $this->fecha = date("Y/m/d");
        $this->autor = $args["autor"] ?? "";
        $this->texto = $args["texto"] ?? "";
        $this->imagen = $args["imagen"] ?? "";
        $this->subtitulo = $args["subtitulo"] ?? "";
    }

    public function validarInputs () : array {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un título"; 
        }
        
        if (!$this->autor) {
            self::$errores[] = "Debes añadir el autor del blog"; 
        }
        
        if (strlen($this->texto) < 50) {
            self::$errores[] = "Debes añadir el texto y este debe ser mayor a 50 caracteres"; 
        }
        
        if (!$this->imagen) {
            self::$errores[] = "Debes añadir una imagen"; 
        }
        
        if (!$this->subtitulo) {
            self::$errores[] = "Debes añadir un subtítulo"; 
        }

        return self::$errores;
    }
}