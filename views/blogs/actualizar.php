<main class="contenedor seccion">
    <h1>Actualiza tu Blog</h1>
    <a href="/admin" class="boton boton-nuevo--form boton-verde">Volver</a>

    <?php foreach($errores as $error): ?>
            <div class="alerta error">
            <?php echo $error; ?>
            </div>
    <?php endforeach; ?>

    <form action="" class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . "/formulario.php"; ?>
        <input type="submit" value="Actualizar Blog" class="boton boton-nuevo--form boton-verde">
    </form>
</main>