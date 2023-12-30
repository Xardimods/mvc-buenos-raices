<?php 
declare(strict_types = 1);
namespace Controlers;
use MVC\Router; 
use Model\Vendedor;

class VendedorControler extends MVCControler {

    public static function create (Router $router) : void {
        
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $vendedor = new Vendedor($_POST["vendedor"]);
            $errores = $vendedor->validarInputs();

            if (empty($errores)) {
                // Guardar en la base de datos 
                $vendedor->create(); 
            }
        } 

        $router->renderView("/vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function update (Router $router) : void {

        $vendedor = new Vendedor; 
        $errores = Vendedor::getErrores();
        $id = redireccionarURL("/admin");
        $vendedor = Vendedor::setFindUpdate($id);

            // Ejecucion luego de que el usuario haga el POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Asignar los atributos
            $args = $_POST["vendedor"];
            $vendedor->sincronizar($args);
            $errores = $vendedor->validarInputs();

            if (empty($errores)) { 
                $vendedor->create();
            }
        }
        
        $router->renderView("/vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores
        ]);
    }

    public static function delete (Router $router) : void {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"]; 
            $id = filter_var($id, FILTER_VALIDATE_INT); 
            
            if ($id) {
                $tipo = $_POST["tipo"];
    
                if (validarContenido($tipo)) {
                    $vendedor = Vendedor::setFindUpdate($id);
                    $vendedor->eliminar();
                } 
            } 
        }
    }
}