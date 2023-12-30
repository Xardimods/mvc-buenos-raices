<fieldset>
    <legend>Información General</legend>

    <label for="nombre">Nombre</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre del Vendedor" value="<?php echo sanitizador($vendedor->nombre); ?>">

    <label for="apellido">Apellido</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido del Vendedor" value="<?php echo sanitizador($vendedor->apellido); ?>">
</fieldset>

<fieldset>
    <legend>Información Extra</legend>
    <label for="telefono">Teléfono</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Número de Teléfono del Vendedor" value="<?php echo sanitizador($vendedor->telefono); ?>">
</fieldset>