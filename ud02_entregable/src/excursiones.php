<?php
session_start();
$clase = "excursiones";
require 'includes/header.php';
if ($_SESSION['correo'] == '1234' && $_SESSION['contraseña'] == '1234') {

} else {
    header("Location: login.php");
}
if (isset($_FILES['miArchivo'])) {
    $directorioDestino = 'files_loaded/';
    $ubicacionFinal = $directorioDestino . basename($_FILES['miArchivo']['name']);
    $tipo = $_FILES['miArchivo']['type'];
    if ($tipo == "image/png" || $tipo == "image/jpeg" || $tipo == "image/jpg" || $tipo == "image/gif") {
        if (move_uploaded_file($_FILES['miArchivo']['tmp_name'], $ubicacionFinal)) {
            echo '<div class="alert alert-success d-flex justify-content-center" role="alert">
                Imagen subida correctamente
                </div>';
        }
    } else {
        echo '<div class="alert alert-danger d-flex justify-content-center" role="alert">
                El tipo de fichero no es una imagen
                </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galería</title>
</head>

<body>
    <h1 class="d-flex justify-content-center">Galería</h1>

    <form action="" method="POST" class="d-flex justify-content-start" enctype="multipart/form-data">
        <div class="d-flex justify-content-start">
            <input type="file" class="form-control" id="inputGroupFile04" name="miArchivo"
                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <button type="submit" class="m-1 btn btn-success">Enviar</button>
        </div>
    </form>

    <div class="container vh-100 d-flex justify-content-center">
    <div id="carouselExampleIndicators" class="carousel slide" style="width: 80%;">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php
            $dire = "files_loaded/";
            $escaner = scandir($dire);
            $cont = 0;
            foreach ($escaner as $clave) {
                if ($clave != "." && $clave != "..") {
                    $cont = $cont + 1;
                    $active = "active";
                    if ($cont != 1) {
                        $active = "";
                    }
                    echo '  <div class="carousel-item ' . $active . '">
                                <img src=' . $dire . $clave . ' class="d-block w-25 h-25">
                                </div>';
                }

            }
            ?>

        </div>
        <button class="carousel-control-prev btn btn-primary" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next btn btn-primary" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    </div >
</body>

</html>