<?php
require './includes/data.php';

require './includes/header.php';
?>
<div class="container">
    <div class="row m-4 justify-content-between">
        <!-- Botón para ver reservas si está logueado -->

        <div class="col-4 mb-4">

        </div>

        <!--FILTRO POR CATEGORÍA-->
        <form class="col-8">

        </form>
    </div>
    <?php
    $libros = getLibros($db);
    $reservas=getReservas($db);

    $contador = 0;

    foreach ($libros as $libro) {
        $reservado=false;
        foreach($reservas as $reserva){
            if($reserva['id_libro']==$libro['id_libro']){
                $reservado=true;
            }
        }

        if ($contador % 3 == 0) {
            echo '<div class="row">'; // Inicia una nueva fila
        }

        echo '<div class="col-md-4 d-flex align-items-stretch pb-1">
        <div class="card shadow">
            <img src="./img/' . $libro['imagen'] . '" class="img-thumbnail w-50" alt="">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">' . $libro['autor'] . '</h5>
                <p class="card-text">
                    <strong>Autor:</strong> ' . $libro['autor'] . '<br>
                    <strong>Categoría:</strong> '.getCategoriaPorID($db, $libro['id_categoria']).'
                </p>';
        if(!$reservado){
            echo '<div class="mt-auto">
                    <button class="btn btn-primary w-100">Reservar</button>
                </div>
            </div>
        </div>
        </div>';
        }else{
            echo '<div class="mt-auto">
                    <button class="btn btn-secondary w-100">No disponible</button>
                </div>
            </div>
        </div>
        </div>';
        }
                

        $contador++;

        if ($contador % 3 == 0) {
            echo '</div>'; // Cierra la fila después de cada 3 libros
        }
    }
    if ($contador % 3 != 0) {
        echo '</div>';
    }
    ?>
    <!-- Modal para mostrar reservas -->

    <div class="modal fade" id="reservasModal" tabindex="-1" aria-labelledby="reservasModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reservasModalLabel">Mis Reservas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Aquí se pueden listar las reservas del usuario -->
                    <p>Aquí se mostrarán las reservas del usuario logueado.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>