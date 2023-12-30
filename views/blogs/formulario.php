<fieldset>
    <legend>Información Personal</legend>

    <label for="autor">Autor</label>
    <input type="text" name="blog[autor]" id="autor" placeholder="Autor del Blog" value="<?php echo sanitizador($blog->autor); ?>">

</fieldset>

<fieldset>
    <legend>Información del Blog</legend>

    <label for="titulo">Título</label>
    <input type="text" name="blog[titulo]" id="titulo" placeholder="Título del Blog" value="<?php echo sanitizador($blog->titulo); ?>">

    <label for="imagen">Imagen</label>
    <input class="contenedor-imagen" type="file" name="blog[imagen]" id="imagen" accept="image/jpeg, image/png">
    <?php if($blog->imagen) { ?>
        <img class="imagen-small" src="/imagenes-blogs/<?php echo $blog->imagen; ?>" alt="Imagen del Blog">
    <?php }?>

    <label for="subtitulo">Subtítulo</label>
    <input type="text" name="blog[subtitulo]" id="subtitulo" placeholder="Subtítulo del Blog" value="<?php echo sanitizador($blog->subtitulo); ?>">

    <label for="texto">Texto del BLog</label>
    <textarea name="blog[texto]" id="texto" cols="30" rows="10" placeholder="Ingresa tu texto (requerido)"><?php echo sanitizador($blog->texto); ?></textarea>
</fieldset>