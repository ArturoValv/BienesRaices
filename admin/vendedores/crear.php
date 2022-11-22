<?php
//Base de Datos
require '../../includes/app.php';

use App\Vendedor;

estaAutenticado();


$vendedor = new Vendedor();

//Consultar para obtener los vendedores
$vendedores = Vendedor::all();


//Arreglo con mensajes de errores
$errores = Vendedor::getErrores();

//Ejecutar el código después de que el usuario envía en formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //Crea una nueva instancia
    $vendedor = new Vendedor($_POST['vendedor']);

    //Validar
    $errores = $vendedor->validar();

    //Insertar en la base de datos
    if (empty($errores)) {
        $vendedor->guardar();
    }
}

incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Registrar Vendedor(a)</h1>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $error) : ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>


    <form action="/admin/vendedores/crear.php" class="formulario" method="POST">

        <?php include '../../includes/templates/formulario_vendedores.php'; ?>

        <input type="submit" value="Registrar Vendedor" class="boton boton-verde">

    </form>
</main>

<?php
incluirTemplate('footer');
?>