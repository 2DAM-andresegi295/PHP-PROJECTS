<?php
session_start();
//sI NO SE HA INSERTADO UN ROL ESTE SERÁ NO
if (!isset($_SESSION['rol'])) {
    $_SESSION['rol'] = "no";
}
require './includes/data.php';

require './includes/header.php';
$libros = getLibros($db);
$categorias = getCategoria($db);
$reservas = getReservas($db);
$usuarios=getUsers($db);

if (isset($_POST['titulo'])) {
    insertarLibro($db,$_POST['titulo'], $_POST['autor'], $_POST['id_categoria'], $_POST['disponible'], $_POST['imagen']);
}
if (isset($_POST["reserva"])) {
    $_SESSION['id_libro_reserva'] = $_POST['reserva'];
    header("Location: reserva.php");
}
if (isset($_POST["eliminar"])) {
    //Se elimina al actualizar la página he probado con heder y con el action...
    $check_eliminar = eliminarLibro($_POST["eliminar"], $db);
}

?>
<div class="container">
    <div class="row m-4 justify-content-between ">
        <!-- Botón para ver reservas si está logueado -->
        <?= $_SESSION['rol'] == "usuario" ? '<div class="col-4 mb-4">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalReservas">Mis reservas</button>
        </div>' : "" ?>

        <?= $_SESSION['rol'] == "administrador" ? '
        <div class="col-4 mb-4">
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalRegistro">Registrar libro</button>
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#listaDeReservas">Lista de reservas</button>
        </div> '  : "" ?>

        <div class="modal fade" id="modalRegistro" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalFormularioLabel">Información</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario enviado con POST directamente a esta misma página -->
                        <form method="POST" >
                            <div class="mb-3">
                                <label for="titulo" class="form-label">Título</label>
                                <input type="text" class="form-control" name="titulo" id="titulo" required>
                            </div>
                            <div class="mb-3">
                                <label for="autor" class="form-label">Autor</label>
                                <input type="text" class="form-control" name="autor" id="autor" required>
                            </div>
                            <div class="mb-3">
                                <label for="id_categoria" class="form-label">ID Categoría</label>
                                <input type="number" class="form-control" name="id_categoria" id="id_categoria"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="disponible" class="form-label">Disponible</label>
                                <select class="form-select" name="disponible" id="disponible" required>
                                    <option value="sí">Sí</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="imagen" class="form-label">URL de Imagen</label>
                                <input type="text" class="form-control" name="imagen" id="imagen">
                            </div>
                            <button type="submit" value="yes" class="btn btn-success">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal" tabindex="-1" id="listaDeReservas">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reservas del usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php
                        foreach ($reservas as $reserva) {
                            echo '<p>Reserva ' . $reserva['id_reserva'] . ': </p>';
                            foreach ($usuarios as $usuario) {
                                if ($reserva['id_usuario']==$usuario['id_usuario']) {
                                    echo '<p>'.'    '.'Usuario: ' .$usuario['nombre_usuario'].' '.$usuario['email']. ' </p>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal" tabindex="-1" id="modalReservas">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reservas del usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <?php

                        foreach ($libros as $libro) {
                            foreach ($reservas as $reserva) {
                                if ($libro['id_libro'] == $reserva['id_libro'] && $reserva['id_usuario'] == $_SESSION['id_usuario']) {
                                    echo '<p>' . $libro['titulo'] . '</p>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <form action="" method="POST" class="input-group col-8  w-50 h-25">
            <select class="form-select" name="categoria" aria-label="Seleccione una categoría">
                <option selected value="-1">Seleccione una categoría</option>
                <?php
                foreach ($categorias as $categoria) {
                    echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['nombre'] . '</option>';
                }
                ?>
            </select>
            <button class="btn btn-success" type="submit" name="accion" value="filtrar">Filtrar</button>
            <button class="btn btn-danger" type="submit" name="accion" value="limpiar">Limpiar</button>
        </form>


    </div>
    <?php
    $contador = 0;

    $categoria_filtrada = -1;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["accion"])) {
        if ($_POST['accion'] == 'filtrar') {
            $categoria_filtrada = $_POST['categoria'];
        }

    }

    foreach ($libros as $libro) {
        $reservado = false;
        foreach ($reservas as $reserva) {
            if ($reserva['id_libro'] == $libro['id_libro']) {
                $reservado = true;
            }
        }

        if ($libro['id_categoria'] == $categoria_filtrada || $categoria_filtrada == -1) {
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
                    <strong>Categoría:</strong> ' . getCategoriaPorID($db, $libro['id_categoria']) . '
                </p>';
            if (!$reservado && $_SESSION['rol'] != 'administrador') {
                echo '<div class="mt-auto">
                <form action="' . ($_SESSION['rol'] == "no" ? "login.php" : "") . '" method="POST">
                <input type="hidden" name="reserva" value="' . $libro['id_libro'] . '">    
                <button type="submit" class="btn btn-primary w-100">Reservar</button>
                </form>
                </div>
            </div>
        </div>
        </div>';

            } elseif ($reservado && $_SESSION['rol'] != 'administrador') {
                echo '<div class="mt-auto">
                    <button type="submit" disabled class="btn btn-secondary w-100">No disponible</button>
                </div>
            </div>
        </div>
        </div>';
            } elseif ($_SESSION['rol'] == 'administrador') {
                echo '<div class="mt-auto">
                <form action="index.php" method="POST">
                <input type="hidden" name="eliminar" value="' . $libro['id_libro'] . '">  
                <button ';
                if ($reservado) {
                    echo ' disabled ';
                }
                echo 'type="submit" class="btn btn-danger w-100">Eliminar</button>
                </form>
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
    }
    if ($contador % 3 != 0) {
        echo '</div>';
    }
    ?>