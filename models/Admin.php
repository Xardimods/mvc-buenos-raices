<?php

declare(strict_types = 1);
namespace Model;

class Admin extends ActiveRecord {

    // Base de datos (BBDD)
    protected static $tabla = "usuarios"; 
    protected static $columnasBBDD = ["id", "email", "password"];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args["id"] ?? null;
        $this->email = $args["email"] ?? "";
        $this->password = $args["password"] ?? "";
    }

    public function validarInputs(): array
    {
        if (!$this->email) {
            self::$errores[] = "El email es obligatorio";
        
        }
        if (!$this->password) {
            self::$errores[] = "La contraseña es obligatoria";
        }

        return self::$errores;
    }

    public function isUserExisted () {
        
        // Revisar la eistencia del usuario
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = "El usuario no existe";
            return;
        }

        return $resultado;
    }

    public function vaildatePasswword ($resultado) : bool {
        $usuario = $resultado->fetch_object();
        $autenticado = password_verify($this->password, $usuario->password);

        if (!$autenticado) {
            self::$errores[] = "La contraseña no es correta"; 
        }

        return $autenticado;
    }

    public function toAuth () : void  {
        session_start(); 

        // Llenar el acceso de session
        $_SESSION["usuario"] = $this->email;
        $_SESSION["login"] = true; 
        header("Location: /admin"); 
    }
}