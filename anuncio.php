<?php

require 'includes/app.php';

use App\Propiedad;

//Validar ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if (!$id) {
    header('Location: /');
}

$propiedad = Propiedad::find($id);

incluirTemplate('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>

    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>">

    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>

        <ul class="iconos-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>

        <p>
            <?php echo $propiedad->descripcion; ?>
            <br>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Molestiae voluptatum et aliquam, magni
            sapiente
            esse, similique earum animi totam nulla illum autem repellendus beatae eius dignissimos dolore repellat?
            Placeat, laboriosam.
            Eligendi, odit perspiciatis? Ducimus sit, veritatis tenetur necessitatibus atque eveniet vitae
            reprehenderit
            sunt, deleniti aspernatur nesciunt eaque. Quos, tenetur consequatur quisquam sunt dolore saepe, eum hic
            dignissimos ipsam magnam unde.
            Quia facere exercitationem nesciunt? Voluptate fugit odit doloribus dolores error nostrum modi harum
            provident a ad corporis expedita unde debitis corrupti exercitationem dolore voluptatibus, earum
            aliquid,
            autem quisquam architecto. Asperiores.
            Nemo sint quod veniam natus deleniti enim dicta, alias cum autem dignissimos quas vitae aperiam rerum
            ipsum
            ratione molestiae delectus culpa quia, accusamus laboriosam excepturi libero consequuntur fugit facere?
            Delectus?
            Ullam repudiandae animi tempore sint accusamus unde mollitia quas, sed laboriosam, qui similique
            excepturi
            adipisci a pariatur quo, voluptates eius voluptatum. Maiores labore ab amet exercitationem, illo animi
            beatae officia!
            Nam veniam excepturi ipsam est, hic repellendus ut corporis illum placeat commodi odit reprehenderit
            nihil
            quaerat a quisquam officia! Esse voluptas rem neque laudantium similique distinctio incidunt sunt iusto
            dolore!
            Totam magnam cupiditate laudantium error. Ipsum veritatis harum dicta tempore at aut, officia
            voluptatibus
            similique! Ut eligendi ratione rerum? Magnam numquam quibusdam amet est, excepturi dolore. Natus, libero
            ipsam? Ipsa.
            Perspiciatis architecto cumque quod tempore excepturi quasi consequatur iusto voluptatibus? Modi a
            voluptate
            iusto officiis commodi veritatis esse tempore sapiente temporibus. Perferendis minus eum nostrum
            inventore?
            Reprehenderit laudantium quasi dolor!
        </p>

    </div>

</main>

<?php incluirTemplate('footer'); ?>