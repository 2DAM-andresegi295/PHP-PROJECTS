<?php

require './includes/data.php';
require './includes/header.php';

// COMPROBACIÓN DE SESIÓN CORRECTA
// if (isset($_SESSION['username']))
// echo $_SESSION['username'];

/* Dependiendo de si se ha establecido un valor en el filtro o no, mostrará
todos los libros o solo recogerá aquellos de la categoría filtrada */
$libros = ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['filtrado'])) ?
            getLibros($db, $_GET['categoriaEscogida'])
            :
            getLibros($db, null);

/* Si se ha pulsado el botón de reservar, comprobará si no está establecida
la sesión de usuario. En caso afirmativo, redirige al login. En caso verdadero,
redirige a la pantalla de reserva, estableciendo un valor con la ID del libro
solicitado en $_SESSION.

En caso de que se haya pulsado el botón de eliminar, eliminará el libro
solicitado, y tras ello, se redirigirá de nuevo a "index.php" para limpiar el buffer */
if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['reservar'])) {
    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['idLibroReserva'] = $_GET['idLibro'];
        header("Location: reserva.php");
        exit();
    }
} else if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET['eliminar'])) {
    eliminarLibro($db, $_GET['idLibro']);
    header("Location: index.php");
    exit();
}

/* Si el usuario actual es administrador, muestra las reservas de todos los
usuarios. En caso contrario, solo mostrará las reservas del usuario actual */
if (isset($_SESSION['username'])) {
    if ($_SESSION['is_admin'] == 0)
        $reservasUsuarioActual = getReservas($db, $_SESSION['username']);
    else if ($_SESSION['is_admin'] == 1)
        $reservasUsuarioActual = getReservas($db);
}

$insercionCorrecta = false;
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['registrar'])) {
    if (!empty($_POST['categoria']) && !empty($_POST['disponibilidad'])) {
        $directorio = './img/';

        if (isset($_FILES['subidaCaratula'])) {
            $archivoImagen = $directorio . basename($_FILES['subidaCaratula']['name']);
            if (pathinfo($archivoImagen, PATHINFO_EXTENSION) == "png" || pathinfo($archivoImagen, PATHINFO_EXTENSION) == "jpg" || pathinfo($archivoImagen, PATHINFO_EXTENSION) == "jpeg") 
                move_uploaded_file($_FILES['subidaCaratula']['tmp_name'], $archivoImagen);
        }
    
        $insercionCorrecta = insertarLibro($db,
        $_POST['titulo'], $_POST['autor'], 
        $_POST['categoria'], $_POST['disponibilidad'], basename($_FILES['subidaCaratula']['name'])
        );
    
        header('Location: index.php');
    }
}

?>

<div class="container">
    <div class="row m-4 justify-content-between">
        <?php
            /* Si el título está establecido, comprueba que la inserción fuera
            correcta y muestra un mensaje. Si no, muestra un mensaje de error. */
            if (isset($_GET['titulo'])) {
                if ($insercionCorrecta)
                    echo "<div class='alert alert-success mt-4 text-center' role='alert'>Inserción de libro correcta</div>";
                else if (!$insercionCorrecta)
                    echo "<div class='alert alert-danger mt-4 text-center' role='alert'>Inserción de libro incorrecta</div>";
            }
        ?>
        <div class="col-4">
            <form>
            <?php
            /** Si la sesión está establecida y el usuario es administrador, muestra los botones de activación
             * de los modales para registrar libros y para mostrar el listado de reservas global.
             * Si el usuario no es administraodr, únicamente solo muestra el botón de activación
             * para mostrar las reservas personales, si las hubiese. */
                if (isset($_SESSION['username']) && $_SESSION['is_admin'] == 1) {
                    echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#registrarLibros'>
                    Registrar libro
                    </button>";
                    echo "<button type='button' class='btn btn-primary ms-3' data-bs-toggle='modal' data-bs-target='#mostrarListadoReservas'>
                    Listado de reservas
                    </button>";
                } else if (isset($_SESSION['username']) && $_SESSION['is_admin'] == 0)
                    echo "<button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#reservasPersonales'>
                    Mis reservas
                    </button>";
            ?>
            </form>
        </div>

        <form class="col-8 d-flex" method="GET">
            <select class="form-select w-75" name="categoriaEscogida">
                <option value="" selected>Seleccione una categoría</option>
                <option value="Novela">Novela</option>
                <option value="Infantil">Infantil</option>
                <option value="Ciencia Ficción">Ciencia Ficción</option>
                <option value="Clásicos">Clásicos</option>
                <option value="Romance">Romance</option>
            </select>
            <input type="submit" class='btn btn-success active' name="filtrado" value="Filtrar">
            <input type="submit" class='btn btn-danger active' value="Limpiar">
        </form>
    </div>

    <div class="row">
        <!-- Por cada libro recogido en la consulta global, muestra los libros en la parte inferior -->
        <?php foreach ($libros as $libro): ?>
            <div class="col-md-4 d-flex align-items-stretch pb-1">
                <div class="card shadow">
                    <?php
                        $nombreImagen = $libro['imagen'];
                        echo "<img src='./img/$nombreImagen' class='img-thumbnail w-50' alt=''>";
                    ?>
                    <div class="card-body d-flex flex-column">
                        <form method="GET">
                            <h5 class="card-title"><?= $libro['titulo']; ?></h5>
                            <p class="card-text">
                                <strong>Autor:</strong> <?= $libro['autor']; ?><br>
                                <strong>Categoría:</strong> <?= $libro['categoria']; ?>
                            </p>
                            <div class="mt-auto">
                                <?php
                                /* Si el libro está disponible, la sesión está establecida y el usuario es administrador, 
                                muestra el botón de eliminar. En caso de que no lo sea, muestra el botón de reservar.
                                Si la sesión no está establecida, muestra el botón de reservar, y si el libro no 
                                está disponible, muestra un botón deshabilitado "No disponible" */
                                    if ($libro['disponible'] == 1) {
                                        if (isset($_SESSION['username'])) {
                                            if ($_SESSION['is_admin'] == 1) 
                                                echo "<input type='submit' name='eliminar' class='btn btn-primary w-100 active' value='Eliminar'>";
                                            else
                                                echo "<input type='submit' name='reservar' class='btn btn-primary w-100 active' value='Reservar'>";
                                        } else 
                                            echo "<input type='submit' name='reservar' class='btn btn-primary w-100 active value='Reservar'>";
                                        echo "<input type='hidden' name='idLibro' value='".$libro['id_libro']."' />";
                                    } else
                                        echo "<button class='btn btn-secondary w-100 disabled'>No disponible</button>";
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- MODAL DE LISTADO DE RESERVAS PERSONALES -->
<div class="modal fade" id="reservasPersonales" tabindex="-1" aria-labelledby="reservasPersonalesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Mis Reservas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título de Libro</th>
                            <th scope="col">Fecha de Reserva</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Por cada reserva que haya hecho el usuario, muestra la información pertinente -->
                        <?php foreach ($reservasUsuarioActual as $reserva): ?>
                            <tr>
                                <th scope="row"><?=$reserva['id_libro']?></th>
                                <td><?=$reserva['titulo']?></td>
                                <td><?=$reserva['fecha_reserva']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA REGISTRAR LIBROS SI EL USUARIO ES ADMINISTRADOR -->
<div class="modal fade" id="registrarLibros" tabindex="-1" aria-labelledby="registrarLibrosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Registrar libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- INFORMACIÓN DE REGISTRO DE LIBRO -->
                <form method="POST" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="titulo" placeholder="Título del libro" aria-label="Titulo Libro" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="autor" placeholder="Autor del libro" aria-label="Autor Libro" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Categoría del libro</span>
                        <select class="form-select" name="categoria" aria-label="Selector categoría" required>
                            <option value="" selected>Seleccione la categoría</option>
                            <option value="1">Novela</option>
                            <option value="2">Infantil</option>
                            <option value="3">Ciencia Ficción</option>
                            <option value="4">Clásicos</option>
                            <option value="5">Romance</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Disponibilidad del libro</span>
                        <select class="form-select" name="disponibilidad" aria-label="Selector disponibilidad" required>
                            <option value="" selected>Seleccione la disponiblidad</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>
                        </select>
                    </div>
                    <div class="input-group mb-3 justify-content-center">
                        <input name="subidaCaratula" type="file" required>
                    </div>
                    <div class="input-group justify-content-center">
                        <input type='submit' name='registrar' value="Registrar libro" class='btn btn-primary w-25 active'>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PARA MOSTRAR LISTADO DE RESERVAS GLOBAL SI EL USUARIO ES ADMINISTRADOR -->
<div class="modal fade" id="mostrarListadoReservas" tabindex="-1" aria-labelledby="mostrarListadoReservasLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservasModalLabel">Listado de Reservas Global</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo electrónico</th>
                            <th scope="col">Título de libro</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- MUESTRA LA INFORMACIÓN PERTINENTE DE TODAS LAS RESERVAS -->
                        <?php foreach ($reservasUsuarioActual as $reserva): ?>
                            <tr>
                                <td><?=$reserva['usuario']?></td>
                                <td><?=$reserva['email']?></td>
                                <td><?=$reserva['titulo']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>