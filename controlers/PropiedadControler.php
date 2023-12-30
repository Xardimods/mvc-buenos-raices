<?php 
declare(strict_types = 1);
namespace Controlers;
use MVC\Router; 
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image; 

class PropiedadControler extends MVCControler {
    public static function create (Router $router) : void {
        
        $propiedad = new Propiedad; 
        $vendedores = Vendedor::getAll();
        $errores = Propiedad::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            
            $propiedad = new Propiedad($_POST["propiedad"]);

            // Generar nombre único para cada archivo 
            $nombreImagen = md5(uniqid("", true)) . ".jpg";

             // Realiza un resize a la imagen con Intervention
            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            } 

            $errores = $propiedad->validarInputs();

            if (empty($errores)) {
                // Crear la carpeta para la creación de Imágenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                
                // Guardar la imagen en el servidor 
                $image->save(CARPETA_IMAGENES . "/" . $nombreImagen);

                // Guardar en la base de datos 
                $propiedad->create(); 
            }
        } 

        $router->renderView("/propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }

    public static function update (Router $router) : void {

        $propiedad = new Propiedad; 
        $vendedores = Vendedor::getAll();
        $errores = Propiedad::getErrores();
        $id = redireccionarURL("/admin");
        $propiedad = Propiedad::setFindUpdate($id);

            // Ejecucion luego de que el usuario haga el POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Asignar los atributos
            $args= $_POST["propiedad"];
            $propiedad->sincronizar($args);
            $errores = $propiedad->validarInputs();
            $nombreImagen = md5(uniqid("", true)) . ".jpg";
            $image = null; 

            if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                // debugParameters($_FILES["propiedad"]["tmp_name"]["imagen"]);
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            } 

            if (empty($errores)) {
                    if ($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                        $image->save(CARPETA_IMAGENES."/".$nombreImagen); 
                    }  
                $propiedad->create();
            }
        }
        
        $router->renderView("/propiedades/actualizar", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
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
                    $propiedad = Propiedad::setFindUpdate($id);
                    $propiedad->eliminar();
                } 
            } 
        }
    }
}