<?php 

declare(strict_types = 1);
require_once __DIR__ . "/../includes/app.php";

use Controlers\BLogsControler;
use Controlers\LoginControler;
use MVC\Router;
use Controlers\PropiedadControler;
use Controlers\VendedorControler;
use Controlers\MVCControler;
use Controlers\PaginasControler;

$router = new Router;
$router->get("/admin", [MVCControler::class, "index"]);

// Zona privada
$router->get("/propiedades/crear", [PropiedadControler::class, "create"]);
$router->post("/propiedades/crear", [PropiedadControler::class, "create"]);
$router->get("/propiedades/actualizar", [PropiedadControler::class, "update"]);
$router->post("/propiedades/actualizar", [PropiedadControler::class, "update"]);
$router->post("/propiedades/eliminar", [PropiedadControler::class, "delete"]);

$router->get("/vendedores/crear", [VendedorControler::class, "create"]);
$router->post("/vendedores/crear", [VendedorControler::class, "create"]);
$router->get("/vendedores/actualizar", [VendedorControler::class, "update"]);
$router->post("/vendedores/actualizar", [VendedorControler::class, "update"]);
$router->post("/vendedores/eliminar", [VendedorControler::class, "delete"]);

$router->get("/blogs/crear", [BLogsControler::class, "create"]);
$router->post("/blogs/crear", [BLogsControler::class, "create"]);
$router->get("/blogs/actualizar", [BLogsControler::class, "update"]);
$router->post("/blogs/actualizar", [BLogsControler::class, "update"]);
$router->post("/blogs/eliminar", [BLogsControler::class, "delete"]);


// Zona pública
$router->get("/", [PaginasControler::class, "index"]);
$router->get("/nosotros", [PaginasControler::class, "nosotros"]);
$router->get("/propiedades", [PaginasControler::class, "propiedades"]);
$router->get("/propiedad", [PaginasControler::class, "propiedad"]);
$router->get("/blogs", [PaginasControler::class, "blogs"]);
$router->get("/entrada", [PaginasControler::class, "entrada"]);
$router->get("/contacto", [PaginasControler::class, "contacto"]);
$router->post("/contacto", [PaginasControler::class, "contacto"]);

// Login y Autenticación
$router->get("/login", [LoginControler::class, "login"]);
$router->post("/login", [LoginControler::class, "login"]);
$router->get("/logout", [LoginControler::class, "logout"]);

$router->comprobarRutas();