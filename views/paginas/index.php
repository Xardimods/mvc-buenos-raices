    <main class="contenedor seccion">
        <h2>Más Sobre Nosotros</h2>

        <?php include __DIR__ . "/iconos.php"; ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>

        <?php
            include __DIR__ . "/listado.php";
        ?>

        <div class="alinear-derecha">
            <a class="boton-verde boton-nuevo" href="/propiedades">Ver Todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tu sueños</h2>
        <p>Llena el formulario de contacto y un asesor se pondrá en contacto contigo a la brevedad.</p>
        <a class="boton-amarillo-inline-block boton-nuevo" href="/contacto">Contáctanos</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro Blog</h3>
            <?php include __DIR__ .  "/listado-entradas.php"; ?>
            <a class="boton-centrado boton-nuevo boton-verde" href="/blogs">Ver Todos</a>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    Tuve una asistencia fenomenal. La calidad de atención al cliente cumplió mis espectactivas y los hogares proporcionados son de mi agrado. Muy recomendado.
                </blockquote>
                <p>- Enyel Liranzo</p>
            </div>
        </section>
    </div>