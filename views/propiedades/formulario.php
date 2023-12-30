<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Título de la propiedad" value="<?php echo sanitizador($propiedad->titulo); ?>">

    <label for="precio">Precio</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio de la propiedad" value="<?php echo sanitizador($propiedad->precio); ?>">

    <label for="imagen">Imagen</label>
    <input class="contenedor-imagen" type="file" name="propiedad[imagen]" id="imagen" accept="image/jpeg, image/png">
    <?php if($propiedad->imagen) { ?>
        <img class="imagen-small" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen de la Propiedad">
    <?php }?>

    <label for="descripcion">Descripción</label>
    <textarea name="propiedad[descripcion]" id="descripcion" cols="30" rows="10" placeholder="Ingresa una descripción"><?php echo sanitizador($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">Habitaciones</label>
    <input type="number" name="propiedad[habitaciones]" id="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo sanitizador($propiedad->habitaciones); ?>">

    <label for="wc">Baños</label>
    <input type="number" name="propiedad[wc]" id="wc" placeholder="Ej: 2" min="1" max="9" value="<?php echo sanitizador($propiedad->wc); ?>">

    <label for="estacionamientos">Estacionamientos</label>
    <input type="number" name="propiedad[estacionamientos]" id="estacionamientos" placeholder="Ej: 4" min="1" max="9" value="<?php echo sanitizador($propiedad->estacionamientos); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>

    <label for="vendedores">Selecciona tu vendedor o vendedora</label>
    <select name="propiedad[vendedores_id]" id="vendedores">
        <option disabled value="" selected>-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor): ?>
            <option <?php echo ($propiedad->vendedores_id === $vendedor->id ) ? "selected" : ""; ?> value="<?php echo sanitizador($vendedor->id); ?>"><?php echo sanitizador($vendedor->nombre) . " " . sanitizador($vendedor->apellido); ?></option>
        <?php endforeach; ?>
    </select>
</fieldset>