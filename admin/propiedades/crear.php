<?php
//Base de Datos
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

estaAutenticado();

$db = conectarDB();

$propiedad = new Propiedad;

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM VENDEDORES;";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

//Ejecutar el código después de que el usuario envía en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Crea una nueva instancia
    $propiedad = new Propiedad($_POST['propiedad']);

    //Subida de Archivos
    //Generar un nombre único
    $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

    //Setear imagen
    //Realiza un resize a la imagen con Intervention
    if ($_FILES['propiedad']['tmp_name']['imagen']) {
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
        $propiedad->setImagen($nombreImagen);
    }

    //Validar
    $errores = $propiedad->validar();

    //Sanitizar con funciones, cambia en POO
    /* $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $creado = date('Y/m/d'); */

    //Insertar en la base de datos
    if (empty($errores)) {

        $propiedad->guardar();

        //Crear carpeta
        $carpetaImagenes = '../../imagenes/';
        if (!is_dir(CARPETAS_IMAGENES)) {
            mkdir(CARPETAS_IMAGENES);
        }

        //Guardar imagen en el server
        $image->save(CARPETAS_IMAGENES . $nombreImagen);
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

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?>