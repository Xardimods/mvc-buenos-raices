<?php 
declare(strict_types = 1);
namespace Controlers;
use MVC\Router;
use Model\Admin;

class LoginControler {
    public static function login (Router $router) : void {
        
        $errores = [];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $auth = new Admin($_POST);
            $errores = $auth->validarInputs();

            if (empty($errores)) {

                // Verificar la existencia del usuario 
                $resultado = $auth->isUserExisted();

                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {

                    // Verificacion del password
                    $autenticado = $auth->vaildatePasswword($resultado);
                    
                    if ($autenticado) {
                        // Autenticación del usuario
                        $auth->toAuth();
                    } else {
                        // Password incorrecto
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->renderView("auth/login", [
            "errores" => $errores
        ]);
    }
    
    public static function logout () : void {
        session_start();
        $_SESSION = [];
        header("Location: /");
    }
}