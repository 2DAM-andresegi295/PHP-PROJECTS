<?php
session_start();
require './includes/data.php';
require './includes/header.php';
$libros = getLibros($db);
var_dump($_SESSION['id_libro_reserva']);
foreach ($libros as $libro) {
    if ($libro['id_libro'] == $_SESSION['id_libro_reserva']) {
        $nombre = $libro['titulo'];
        $autor = $libro['autor'];
        $imagen = $libro['imagen'];
        $id_libro=$libro['id_libro'];
        $disponible = $libro['disponible'];
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"&& isset($_POST["confirmacion"])){
    if ($_POST["confirmacion"]='Confirmar') {
       var_dump(hacerReserva($_SESSION['id_usuario'],$id_libro,$_POST["fecha"],$db)); 
    }
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formalización de reserva</title>
</head>

<body>
    <h1 class="d-flex justify-content-center">Formalización de reserva</h1>
    <div class="d-flex justify-content-center">
        <div class="card " style="width: 18rem;">
            <form method="POST" >
            <img src="./img/<?= $imagen ?>" class="card-img-center w-50" alt="...">
            <div class="card-body">
                <h5 class="card-title">Título: <?= $nombre ?></h5>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Autor: <?= $autor ?></li>
                <li class="list-group-item"> Seleccione la fecha de la reserva:
                    <input type="date" id="fecha" name="fecha" name="fecha">
                </li>
            </ul>
            <div class="card-body">
                <button name="confirmacion" type="submit" class="btn btn-success" value="Confirmar">Confirmar</button>
                <button name="confirmacion" type="submit" class="btn btn-danger" value="Cancelar">Cancelar</button>
            </div>
            </form>
        </div>
    </div>

</body>

</html>