<?php

use App\Propiedad;

require '../../includes/app.php';

estaAutenticado();
//Validar ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /admin');
}

//Consultar los datos de la propiedad
$propiedad = Propiedad::find($id);

//Consultar para obtener los vendedores
$consulta = "SELECT * FROM VENDEDORES;";
$resultado = mysqli_query($db, $consulta);

//Arreglo con mensajes de errores
$errores = Propiedad::getErrores();

//Ejecutar el código después de que el usuario envía en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Asignar los atributos
    $args = $_POST['propiedad'];

    $propiedad->sincronizar($args);

    $errores = $propiedad->validar();

    //Insertar en la base de datos
    if (empty($errores)) {

        //Crear carpeta
        $carpetaImagenes = '../../imagenes/';

        if (!is_dir($carpetaImagenes)) {
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        //Subida de Archivos

        if ($imagen['name']) {
            //Eliminar imagen previa
            unlink($carpetaImagenes . $propiedad['imagen']);

            //Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //Subir la Imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen'];
        }


        //Insertar en base de datos
        $query = " UPDATE propiedades SET titulo = 
        '${titulo}', precio = '${precio}', imagen = '${nombreImagen}', descripcion = '${descripcion}', habitaciones = ${habitaciones}, 
        wc = ${wc}, estacionamiento = ${estacionamiento}, vendedorId = ${vendedorId} WHERE id = ${id}";

        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            //Redireccionar al usuario
            header("Location: /admin?resultado=2");
        }
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form class="formulario" method="POST" enctype="multipart/form-data">

        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

        <input type="submit" value="Actualizar Propiedad" class="boton boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?>