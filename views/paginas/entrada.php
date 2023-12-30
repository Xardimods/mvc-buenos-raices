<main class="contenedor seccion contenido-centrado">

<a href="/blogs" class="boton-nuevo boton boton-verde">Volver</a>

<?php
    use Model\Blogs;
    $id = $_GET["id"];
    $blog = Blogs::setFindUpdate($id);
?>
    <h1><?php echo $blog->titulo ?></h1>

    <picture>
        <img loading="lazy" src="/imagenes-blogs/<?php echo $blog->imagen ?>" alt="Imagen Destacada">
    </picture>

    <p class="informacion-meta">Escrito el: <span><?php echo $blog->fecha ?></span> por: <span><?php echo $blog->autor ?></span></p>

    <div class="resumen-propiedad">
        <p>
            <?php echo $blog->texto ?>
        </p>
    </div>
</main>