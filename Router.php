<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) : void {
        $this->rutasGET[$url] = $fn;  
    }

    public function post($url, $fn) : void {
        $this->rutasPOST[$url] = $fn;  
    }

    public function comprobarRutas () : void {

        session_start();

        $auth = $_SESSION["login"] ?? null;

        // Arreglo de rutas protegidas. 
        $rutas_protegidas = ["/admin", "/propiedades/crear", "/propiedades/actualizar", "/propiedades/eliminar", "/vendedores/crear", "/vendedores/actualizar", "/vendedores/eliminar", "/blogs/crear", "/blogs/actualizar", "/blogs/eliminar"];


        $urlActual = strtok($_SERVER['REQUEST_URI'], '?') ?? '/';
        $metodo = $_SERVER["REQUEST_METHOD"];

        if ($metodo == "GET") {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header("Location: /");
        }

        if ($fn) {
            // Existe con una función asociada
            call_user_func($fn, $this);
        } else {
            echo "Error 404: Página o recurso no encontrado.";
        }
    }

    // Mostrar Vista

    public function renderView ($view, $data = []) : void {

        foreach ($data as $key=>$value) {
            $$key = $value; // la clave será la indicada
        }

        ob_start();
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // Limpiando el servidors
        include __DIR__ . "/views/layout.php";
    }
}