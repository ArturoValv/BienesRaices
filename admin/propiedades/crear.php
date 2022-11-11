<?php
//Base de Datos
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$db = conectarDB();

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM VENDEDORES;";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';

//Ejecutar el código después de que el usuario envía en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Crea una nueva instancia
    $propiedad = new Propiedad($_POST);

    //Subida de Archivos
    //Generar un nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear imagen
    //Realiza un resize a la imagen con Intervention
    if ($_FILES['imagen']['tmp_name']) {
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    //Validar
    $errores = $propiedad->validar();

    //Sanitizar con funciones, cambia en POO
    /* $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $creado = date('Y/m/d'); */

    //Insertar en la base de datos
    if (empty($errores)) {

        $resultado = $propiedad->guardar();

        //Crear carpeta
        $carpetaImagenes = '../../imagenes/';
        if (!is_dir(CARPETAS_IMAGENES)) {
            mkdir(CARPETAS_IMAGENES);
        }

        //Guardar imagen en el server
        $image->save(CARPETAS_IMAGENES . $nombreImagen);

        //Subir la Imagen con funciones
        /* move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen); */

        //Guardar en la BD

        //Mensaje de éxito o error
        if ($resultado) {
            //Redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Crear</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form action="/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>

            <legend>Información General</legend>

            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" placeholder="Títlulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for="imagen">Imagen:</label>
            <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

            <label for="descripcion">Descripcion</label>
            <textarea name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>


        </fieldset>

        <fieldset>

            <legend>Información de la Propiedad</legend>

            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej.: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej.: 3" min="1" max="9" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamientos:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej.: 3" min="1" max="9" value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>

            <legend>Vendedor</legend>

            <select name="vendedorId" id="">
                <option value="" selected>--Seleccione--</option>
                <?php while ($vendedor = mysqli_fetch_assoc($resultado)) : ?>
                    <option <?php echo $vendedorId === $vendedor['id'] ? 'selected' : ' '; ?> value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

        </fieldset>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?>