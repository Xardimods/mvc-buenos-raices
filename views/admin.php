<main class="contenedor seccion">
    <h1>Administrador de Bienes Raíces</h1>
    <?php

use Model\Blogs;

    if ($resultado) {
        $mensaje = showNotifications(intval($resultado)); ?>
        <?php if ($mensaje) : ?>
            <p class="alerta exito"><?php echo sanitizador($mensaje); ?></p>
        <?php endif; ?>
    <?php  } ?>

    <h2>Propiedades</h2>
    <a href="/propiedades/crear" class="boton-nuevo boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados de la consulta -->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td data-title = "ID"><?php echo $propiedad->id; ?></td>
                    <td data-title = "Título"><?php echo $propiedad->titulo; ?></td>
                    <td data-title = "Imagen"> <img class="imagen-tabla" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen Procesada"> </td>
                    <td data-title = "Precio">USD$<?php echo $propiedad->precio; ?></td>
                    <td data-title = "Acciones">
                        <form action="/propiedades/eliminar" method="POST" class="w-100">
                            <!-- INPUT HIDDEN -->
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>
    <a href="vendedores/crear" class="boton boton-nuevo boton-amarillo-inline-block">Nuevo Vendedor</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mostrar los resultados de la consulta -->
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td data-title="ID"><?php echo $vendedor->id; ?></td>
                    <td data-title="Nombre"><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                    <td data-title="Teléfono"><?php echo $vendedor->telefono ?></td>
                    <td data-title="Acciones">
                        <form action="/vendedores/eliminar" method="POST" class="w-100">
                            <!-- INPUT HIDDEN -->
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


    <h2>Tus blogs</h2>
    <a href="blogs/crear" class="boton boton-nuevo--blog boton-amarillo-inline-block">Nuevo Blog</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Fecha</th>
                <th>Autor</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
        </thead>

            <tbody>
                <?php foreach ($blogs = Blogs::getAll() as $blog) : ?>
                <tr>
                    <td data-title="ID"><?php echo $blog->id; ?></td>
                    <td data-title="Título"><?php echo $blog->titulo; ?></td>
                    <td data-title="Fecha"><?php echo $blog->fecha; ?></td>
                    <td data-title="Autor"><?php echo $blog->autor; ?></td>
                    <td data-title="Imagen"> <img class="imagen-tabla" src="/imagenes-blogs/<?php echo $blog->imagen; ?>" alt="Imagen Procesada"> </td>
                    <td data-title="Acciones">
                        <form action="/blogs/eliminar" method="POST" class="w-100">
                            <!-- INPUT HIDDEN -->
                            <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/blogs/actualizar?id=<?php echo $blog->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
    </table>
</main>