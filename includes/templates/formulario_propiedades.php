 <fieldset>

     <legend>Información General</legend>

     <label for="titulo">Título:</label>
     <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Títlulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

     <label for="precio">Precio:</label>
     <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

     <label for="imagen">Imagen:</label>
     <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

     <?php if ($propiedad->imagen) : ?>

         <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small">

     <?php endif; ?>

     <label for="descripcion">Descripcion</label>
     <textarea name="propiedad[descripcion]" id="descripcion"><?php echo s($propiedad->descripcion); ?></textarea>


 </fieldset>

 <fieldset>

     <legend>Información de la Propiedad</legend>

     <label for="habitaciones">Habitaciones:</label>
     <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej.: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">

     <label for="wc">Baños:</label>
     <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej.: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">

     <label for="estacionamiento">Estacionamientos:</label>
     <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej.: 3" min="1" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">

 </fieldset>

 <fieldset>

     <legend>Vendedor</legend>

     <select name="vendedorId" id="">
         <option value="" selected>--Seleccione--</option>
         <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
             <option <?php echo s($propiedad->vendedorId) === s($propiedad->vendedor['id']) ? 'selected' : ' '; ?> value="<?php echo s($propiedad->vendedor['id']); ?>">
                 <?php echo s($propiedad->vendedor['nombre']) . " " . s($propiedad->vendedor['apellido']); ?>
             </option>
         <?php endwhile; ?>
     </select>

 </fieldset>