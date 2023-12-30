<?php 

define("TEMPLATES_URL", __DIR__ . "/templates");
define('FUNCIONES_URL', __DIR__ . '/funciones.php');
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes");
define("CARPETA_BLOGS_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . "/imagenes-blogs");

function incluirTemplate(string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}

function getAutenticatedClient () : void {
    session_start();
    if (!$_SESSION["login"]) {
        header("Location: /");
    }  
}

function debugParameters ($variable) : void {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapar / Sanitizar el HTML 

function sanitizador ($html) : string {
    $s = htmlspecialchars($html); 
    return $s;
}

// Validar tipo de contenido 

function validarContenido ($tipo) : bool {
    $tipos = ["vendedor", "propiedad"];
    return in_array($tipo, $tipos);
}

// Mostrar los mensaje de alerta

function showNotifications ($codigo) : string {
    $mensaje = "";

    switch ($codigo) {
        case 1: 
            $mensaje = "¡Se ha creado correctamente!";
            break;
        case 2: 
            $mensaje = "¡Se ha actualizado correctamente!";
            break;
        case 3: 
            $mensaje = "¡Se ha eliminado correctamente!";
            break;
        default: 
            $mensaje = false;
            break;
    }

    return $mensaje;
}

function redireccionarURL (string $url) : int {

    // Validación del ID
    $id = $_GET["id"]; 
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if (!$id) {
        header("Location: $url");
    }

    return $id;
} 