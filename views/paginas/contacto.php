<main class="contenedor seccion">
    <h1>Contacto</h1>

    <?php  if ($mensaje):  ?> 
        <p class="alerta exito"><?php echo $mensaje ?></p>
    <?php endif; ?>

    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img src="build/img/destacada3.jpg" alt="Imagen Destacada">
    </picture>

    <h2>Llena el formulario de contacto</h2>

    <form class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" name="contacto[nombre]" id="nombre" required>

            <label for="mensaje">Mensaje</label>
            <textarea name="contacto[mensaje]" placeholder="Escribe tu mensaje" id="mensaje" cols="30" rows="10" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select name="contacto[tipo]" id="opciones" required>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="compra">Compra</option>
                <option value="vende">Vende</option>
            </select>

            <div id="tipo">

            </div>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <p>¿Cómo desea ser contactado?</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" name="contacto[contacto]" id="contactar-telefono" required>

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" name="contacto[contacto]" id="contactar-email" required>
            </div>

            <div id="contacto">

            </div>
        </fieldset>

        <input type="submit" value="Enviar" class="boton-nuevo--form boton-centrado boton-verde">
    </form>
</main>