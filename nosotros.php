<?php
require 'includes/app.php';
incluirTemplate('header');
?>

<main class="contenedor seccion">
    <h1>Conoce sobre Nosotros</h1>

    <div class="contenido-nosotros">

        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="Sobre Nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <blockquote>
                25 Años de Experiencia
            </blockquote>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae fuga quas tenetur laboriosam
                excepturi, repellat vitae debitis nam. Molestiae ipsum neque cupiditate quis quidem nisi itaque
                fugit eum blanditiis magni.
                Dolor nostrum ea ad excepturi voluptatibus facere vel explicabo ratione, voluptate reiciendis vitae.
                Id, minus quibusdam? Adipisci beatae consequatur accusamus, autem facilis dolorem expedita! Minima
                provident eligendi modi tempore quae.</p>

            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates pariatur commodi dolores nam
                corrupti maiores adipisci alias dolor sunt. Ad ipsam blanditiis fugiat aliquid accusamus. Dolorem
                nobis quos esse deserunt?
                Blanditiis asperiores tenetur quis rerum sint! Pariatur ducimus excepturi reprehenderit iure
                repudiandae doloribus porro quos. Qui fugit odio magni sit vel in repellendus, tenetur deserunt
                nobis officia reiciendis consequuntur expedita.</p>

        </div>

    </div>
</main>

<section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum quas autem animi earum! Quae cumque
                numquam beatae a expedita ex ullam ab, temporibus doloribus ut sint, eveniet totam, eligendi
                asperiores.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="icono precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum quas autem animi earum! Quae cumque
                numquam beatae a expedita ex ullam ab, temporibus doloribus ut sint, eveniet totam, eligendi
                asperiores.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="icono tiempo" loading="lazy">
            <h3>Tiempo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum quas autem animi earum! Quae cumque
                numquam beatae a expedita ex ullam ab, temporibus doloribus ut sint, eveniet totam, eligendi
                asperiores.</p>
        </div>
    </div>

</section>

<?php
incluirTemplate('footer');
?>