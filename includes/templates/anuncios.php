<?php 
    use App\Propiedad;

    if ($_SERVER["SCRIPT_NAME"] === "/anuncios.php" ) {
        $propiedades = Propiedad::getAll();
    } else {
        $propiedades = Propiedad::getRequestedRows(3);
    }
?>


<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio">
        <img loading="lazy" src="/includes/imagenes/<?php echo $propiedad->imagen; ?>"  alt="Anuncio">
        <div class="contenido-anuncio">
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p><?php $propiedad->descripcion; ?></p>
            <p class="precio precio-anuncios">USD$<?php echo $propiedad->precio; ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                    <p><?php echo $propiedad->wc; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                    <p><?php echo $propiedad->estacionamientos; ?></p>
                </li>
                <li>
                    <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Dormitorios">
                    <p><?php echo $propiedad->habitaciones; ?></p>
                </li>
            </ul>

            <a class="boton-amarillo-block" href="anuncio.php?id=<?php echo $propiedad->id; ?>">
                Ver Propiedad
            </a>
        </div> <!--Contenido Anuncio-->
    </div> <!--Anuncio-->
    <?php endforeach; ?>
</div> <!--Contenedor Anuncios-->