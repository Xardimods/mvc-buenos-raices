<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    
    $auth = $_SESSION["login"] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? "inicio" : ""; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img class="logo-header" src="/build/img/logo.svg" alt="Bienes-Raices-logo">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menú Responsive">
                </div>

                <div class="derecha">
                    <nav class="navegacion">
                        <a href="../../nosotros.php">Nosotros</a>
                        <a href="../../anuncios.php">Anuncios</a>
                        <a href="../../blog.php">Blog</a>
                        <a href="../../contacto.php">Contactos</a>
                        <?php if($auth){ ?>
                            <a href="../../admin/index.php">Administrador</a>
                            <a href="../../cerrar-sesion.php">Cerrar Sesión</a>
                        <?php } else { ?>
                            <a href="login.php">Iniciar Sesión</a>
                        <?php }; ?>
                    </nav>
                    <img class="dark-mode-boton" src="/build/img/dark-mode.svg" alt="Botón Dark Mode">
                </div>
            </div>
            <?php if ($inicio) { ?>
                <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
            <?php }; ?>
        </div> <!--Cierre de la barra-->
    </header>