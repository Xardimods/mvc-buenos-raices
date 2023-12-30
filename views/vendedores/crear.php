<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>
    <a href="/admin" class="boton boton-nuevo--form boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <form action="" class="formulario" action="" method="POST">
        <?php include __DIR__ . "/formulario.php"; ?>
        <input type="submit" value="Registrar Vendedor" class="boton boton-verde boton-nuevo--form">
    </form>
</main>