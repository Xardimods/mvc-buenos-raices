<?php 

declare(strict_types = 1);
namespace Controlers;

use MVC\Router;
use Model\Propiedad;
use Model\Blogs;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasControler {

    public static function index (Router $router) : void {
        
        $propiedades = Propiedad::getRequestedRows(3);
        $blogs = Blogs::getRequestedRows(2);
        $inicio = true;


        $router->renderView("paginas/index", [
            "propiedades" => $propiedades,
            "blogs" => $blogs,
            "inicio" => $inicio
        ]);
    }
    public static function nosotros (Router $router) : void {
        $router->renderView("paginas/nosotros", []);
    }
    public static function propiedades (Router $router) : void {
        $propiedades = Propiedad::getAll();
        $router->renderView("paginas/propiedades", [
            "propiedades" => $propiedades
        ]);
    }
    public static function propiedad (Router $router) : void {

        $id = redireccionarURL("/propiedades");
        $propiedad = Propiedad::setFindUpdate($id);

        $router->renderView("paginas/propiedad", [
            "propiedad" => $propiedad
        ]);
    }
    public static function blogs (Router $router) : void {
        $blogs = Blogs::getAll();
        $router->renderView("paginas/blogs", [
            "blogs" => $blogs
        ]);
    }
    public static function entrada (Router $router) : void {
        $router->renderView("paginas/entrada", [

        ]);
    }
    public static function contacto (Router $router) : void {

        $mensaje = null;

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $respuesta = $_POST["contacto"];

            // Creacion de una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurrar SMTP
            $mail->isSMTP();
            $mail->Host = $_ENV["EMAIL_HOST"];
            $mail->SMTPAuth = true; 
            $mail->Username = $_ENV["EMAIL_USER"];
            $mail->Password = $_ENV["EMAIL_PASS"];
            $mail->SMTPSecure = "tls"; // Forma de certificar
            $mail->Port = $_ENV["EMAIL_PORT"];

            // Configuracion del contenido del mail
            $mail->setFrom("admin@bienesraices.com"); // Quién envía el mail
            $mail->addAddress("admin@bienesraices.com", "BienesRaíces.com"); // Formato de cómo se recibe el email. 
            $mail->Subject = "¡Tienes un nuevo mensaje!";

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            // Definir el contenido
            $contenido = "<html>";
            $contenido.= "<p>Tienes un nuevo mensaje</p>";
            $contenido.= "<p>Nombre: " . $respuesta["nombre"] . "</p>";
            $contenido.= "<p>Método de contacto: " . $respuesta["contacto"] . "</p>";

            // Enviar de forma conducional algunos campos dependiendo de la selección del cliente
            if ($respuesta["contacto"] === "telefono") {
                // En el caso de teléfono
                $contenido.= "<p>Ha elegido ser contactado por teléfono: </p>";
                $contenido.= "<p>Teléfono: " . $respuesta["telefono"] . "</p>";
                $contenido.= "<p>Fecha del contacto: " . $respuesta["fecha"] . "</p>";
                $contenido.= "<p>Hora del contacto: " . $respuesta["hora"] . "</p>";
            } else {
                // En el caso del email. 
                $contenido.= "<p>Ha elegido ser contactado por email: </p>";
                $contenido.= "<p>Email: " . $respuesta["email"] . "</p>";
            }

            $contenido.= "<p>Vende o Compra: " . $respuesta["tipo"] . "</p>";
            
            if ($respuesta["tipo"] === "compra") {
                $contenido.= "<p>Presupuesto: $" . $respuesta["presupuesto"] . "</p>";
            } else {
                $contenido.= "<p>Precio: $" . $respuesta["presupuesto"] . "</p>";
            }

            $contenido.= "<p>Mensaje: " . $respuesta["mensaje"] . "</p>";
            $contenido.= "</html>";


            $mail->Body = $contenido;
            $mail->AltBody = "Esto es texto alternativo sin HTML";

            // Envíar el email
            if ($mail->send()) {
                $mensaje = "Mensaje enviado correctamente";
            } else {
                $mensaje = "No se ha podido envíar el mensaje";
            }
        }

        $router->renderView("paginas/contacto", [
            "mensaje" => $mensaje
        ]);
    }
}
