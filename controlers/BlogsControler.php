<?php

declare(strict_types = 1);
namespace Controlers;
use MVC\Router; 
use Model\Blogs;
use Intervention\Image\ImageManagerStatic as Image;

class BLogsControler {

    public static function create (Router $router) : void  {

        $blog = new Blogs;
        $errores = Blogs::getErrores();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $blog = new Blogs($_POST["blog"]);

            $nombreImagen = md5(uniqid("", true)) . ".jpg";
            
            if ($_FILES["blog"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["blog"]["tmp_name"]["imagen"])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }

            $errores = $blog->validarInputs();

            if (empty($errores)) {
                // Crear la carpeta para la creación de Imágenes
                if (!is_dir(CARPETA_BLOGS_IMAGENES)) {
                    mkdir(CARPETA_BLOGS_IMAGENES);
                }
                
                // Guardar la imagen en el servidor 
                $image->save(CARPETA_BLOGS_IMAGENES . "/" . $nombreImagen);

                // Guardar en la base de datos 
                $blog->create(); 
            }
        }

        $router->renderView("/blogs/crear", [
            "blog" => $blog,
            "errores" => $errores
        ]);
    }

    public static function update (Router $router) : void {

        $blog = new Blogs;
        $errores = Blogs::getErrores();
        $id = redireccionarURL("/admin");
        $blog = Blogs::setFindUpdate($id);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Asignar los atributos
            $args= $_POST["blog"];
            $blog->sincronizar($args);
            $errores = $blog->validarInputs();
            $nombreImagen = md5(uniqid("", true)) . ".jpg";
            $image = null; 

            if ($_FILES["blog"]["tmp_name"]["imagen"]) {
                $image = Image::make($_FILES["blog"]["tmp_name"]["imagen"])->fit(800, 600);
                $blog->setImagen($nombreImagen);
            } 

            if (empty($errores)) {
                if ($_FILES["blog"]["tmp_name"]["imagen"]) {
                    $image->save(CARPETA_BLOGS_IMAGENES."/".$nombreImagen); 
                }  
                $blog->create();
        }
        }

        $router->renderView("/blogs/actualizar", [
            "blog" => $blog,
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
                    $blog = Blogs::setFindUpdate($id);
                    $blog->eliminar();
                } 
            } 
        }
    }
}