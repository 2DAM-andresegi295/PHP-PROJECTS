<?php

require './includes/data.php';
require './includes/header.php';

/* Obtiene el listado global de libros, el cual es filtrado
posteriormente con una variable preestablecida en $_SESSION */
$libroAReservar = getLibros($db, null);

/* Si se ha pulsado el botón de reservar y la fecha de reserva está
establecida, llama a la función de reservar el libro con los parámetros necesarios */
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['reservar'])) {
    if (!empty($_GET['fechaReserva'])) {
        reservarLibro($db, $_SESSION['username'], $_SESSION['idLibroReserva'], $_GET['fechaReserva']);

        unset($_SESSION['idLibroReserva']);
        header("Location: index.php");
        exit(); 
    }
} 

?>

<div class="container">
    <h2 class="my-4 text-center">Libro a reservar</h2>
    <div class="row my-4 justify-content-center">
        <div class="card shadow w-25">
            <?php foreach ($libroAReservar as $libro) : ?>
                <!-- Filtra por la ID del libro establecido en $_SESSION -->
                <?php if ($libro['id_libro'] == $_SESSION['idLibroReserva']) : ?>
                    <div class="my-2 d-flex align-items-stretch pb-1">
                        <div class="card shadow">
                            <?php
                                $nombreImagen = $libro['imagen'];
                                echo "<img src='./img/$nombreImagen' class='img-thumbnail w-50' alt=''>";
                            ?>
                            <div class="card-body d-flex flex-column">
                                <form method="GET">
                                    <span name="idLibro" value="<?=$libro['id_libro']?>" aria-hidden=true></span>
                                    <h5 class="card-title"><?= $libro['titulo']; ?></h5>
                                    <p class="card-text">
                                        <strong>Autor:</strong> <?= $libro['autor']; ?><br>
                                        <strong>Categoría:</strong> <?= $libro['categoria']; ?>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <form method="GET" class="row ms-5 w-25 d-flex">
            <input type="date" name="fechaReserva" class="my-auto mx-auto" min="2020/01/01" max="2026/12/31">
            <input type="submit" class="btn btn-primary my-auto mx-auto" name="reservar" value="Reservar">
        </form>
    </div>
</div>