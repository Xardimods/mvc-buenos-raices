<?php
declare(strict_types = 1);

namespace Model; 

class ActiveRecord  {
        
    // BBDD
    protected static $db;
    protected static $columnasBBDD = [];
    protected static $tabla = "";

    // Validación de errores 
    protected static $errores = [];

    // Definir la conexión a la BBDD
    public static function setDB ($database) : void {
        self::$db = $database;
    }

    public function save () {

        // Sanitizar los datos
        $atributos = $this->sanitizarDatos();

        // Inserción de los datos a la BBDD
        $query = "INSERT INTO " . static::$tabla . "( "; 
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES (' "; 
        $query .= join("', '", array_values($atributos));
        $query .= " ')";

        $resultado = self::$db->query($query);
        
        if ($resultado) {
            // Redireccionar al usuario
            header("Location: /admin?resultado=1");
        }
    }

    public function create() : void {
        if (is_null($this->id)) {
            $this->save();
        } else {
            // Actualizar
            $this->update();
        }
    }

    public function update () : void {
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "$key = '$value'";
        }

        $query = "UPDATE " . static::$tabla . " SET "; 
        $query.= join(", ", $valores);
        $query.= " WHERE id ='" . self::$db->escape_string($this->id) . "' ";
        $query.= " LIMIT 1 ";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
    }

    // Eliminar un registro 

    public function eliminar() {
        $query = "DELETE FROM ". static::$tabla . " WHERE id = ". self::$db->escape_string($this->id . " LIMIT 1");

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Borrar la imagen
            $this->deleteImageBBDD(); 

            // Redireccionar al usuario
            header("Location: /admin?resultado=3");
        }
    }

    // Identificar los atributos de la BBDD
    public function atributos () : array {
        $atributos = []; 
        foreach (static::$columnasBBDD as $columna) {
            if ($columna === "id") continue; // Ignorar el proceso natural de la operación
            $atributos[$columna] = $this->$columna; 
        }

        return $atributos;
    }

    public function sanitizarDatos () : array {
        // debugParameters("Sanitizando..."); 
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key=>$value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Subida de archivos 

    public function setImagen ($imagen) : void {

        // Eliminar imagen si hay edición
        if (!is_null($this->id)) {
            // Comprobar si existe un archivo en el servidor
            $this->deleteImageBBDD();
        }

        // Asignación de la imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen; 
        }
    } 

    public function deleteImageBBDD () : void {
        // debugParameters("Eliminando Imagen...");
        $existeArchivo = file_exists(CARPETA_IMAGENES . "/" . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . "/" . $this->imagen);
        }
    }

    // Validación

    public static function getErrores () : array {
        return static::$errores;
    }

    public function validarInputs () : array {
        static::$errores = [];
        return static::$errores;
    }

    // Listar todos los registros

    public static function getAll () : array {
        // debugParameters("Consultando los datos de la BBDD");
        $query = "SELECT * FROM " . static::$tabla; 
        $resultado = self::consultasSQL($query);
        
        return $resultado;
    }

    // Obtener una cantidad específica de registros

    public static function getRequestedRows ($cantidad) : array {
        // debugParameters("Consultando los datos de la BBDD");
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; 
        $resultado = self::consultasSQL($query);
        
        return $resultado;
    }

    // Buscar una propiedad por su ID 

    public static function setFindUpdate ($id) : object {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id"; 

        $resultado = self::consultasSQL($query);
        return array_shift($resultado);
    }

    public static function consultasSQL ($query) : array {
        // Consultar la base de datos 
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro); 
        }

        // Liberar la memoria
        $resultado->free();
        
        // Retornar los resultados
        return $array;
    }

    protected static function crearObjeto ($registro) : object {
        $objeto = new static; 

        foreach ($registro as $key=>$value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }

        return $objeto; 
    }

    // Sincronización de los datos del objeto en memoria con los cambios realizados por el usuario. 
    
    public function sincronizar ($args = []) : void {
        foreach ($args as $key=>$value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}