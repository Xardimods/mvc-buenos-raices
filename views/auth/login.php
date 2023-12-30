<main class="contenedor seccion contenido-centrado main-completo">
        <h1>Iniciar Sesión</h1>

        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>
        
        <form class="formulario" method="POST" action="/login">
        <fieldset>
            <legend>Correo Electrónico y Contraseña</legend>

            <label for="email">Introduce tu correo electrónico</label>
            <input type="email" placeholder="example@email.net"  name="email" id="email">

            <label for="password">Introduce tu contraseña</label>
            <input type="password" placeholder="Tu contraseña"  name="password" id="password">
            </fieldset>

            <input class="boton-centrado boton boton-verde" type="submit" value="Iniciar Sesión">
        </form>
    </main>