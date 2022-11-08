<?php
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Contacto</h1>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto">
    </picture>

    <h2>Llena el formulario de Contacto</h2>

    <form class="formulario" action="">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" name="nombre" id="nombre">

            <label for="email">E-mail</label>
            <input type="text" placeholder="Tu e-mail" name="email" id="email">

            <label for="telefono">Teléfono</label>
            <input type="tel" placeholder="Tu teléfono" name="telefono" id="telefono">

            <label for="mensaje">Mensaje</label>
            <textarea name="mensaje" id="mensaje"></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>

            <label for="opciones">Vende o Compra</label>
            <select name="opciones" id="opciones">
                <option value="" disabled selected>--Seleccione--</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>

            <label for="presupuesto">Precio o Presupuesto</label>
            <input type="number" placeholder="Tu Precio o Presupuesto" name="presupuesto" id="presupuesto">
        </fieldset>

        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <p>¿Cómo desea ser contactado?</p>

            <div class="forma-contacto">

                <label for="contactar-telefono">Teléfono</label>
                <input type="radio" value="telefono" id="contacactar-telefono" name="contacto">

                <label for="contactar-email">E-mail</label>
                <input type="radio" value="email" id="contacactar-email" name="contacto">

            </div>

            <p>Si eligió teléfono, elija la fecha y la hora para ser contactado:</p>

            <label for="fecha">Fecha</label>
            <input type="date" name="fecha" id="fecha">

            <label for="hora">Hora</label>
            <input type="time" name="hora" id="hora" min="9:00" max="18:00">

            <input type="submit" value="Enviar" class="boton boton-verde">

        </fieldset>
    </form>
</main>

<?php
incluirTemplate('footer');
?>