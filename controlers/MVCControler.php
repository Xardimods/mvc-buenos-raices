<?php 
declare(strict_types = 1);
namespace Controlers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class MVCControler {

    public static function index (Router $router) : void { // Pasar un objeto
        
        $propiedades = Propiedad::getAll();
        $vendedores = Vendedor::getAll();
        $resultado = $_GET["resultado"] ?? null; 

        $router->renderView("/admin", [
            "propiedades" => $propiedades,
            "vendedores" => $vendedores,
            "resultado" => $resultado
        ]);
    }
}