<?php
session_start();
$clase = "Galería";

if($_SESSION['usuario']!= '1234'&& $_SESSION['contraseña']!= '1234'&&$_SESSION['rep_contrasena']!='1234'){ 
    header("Location: login.php");
    exit();
}
if (isset($_FILES['miArchivo'])) {
    $directorioDestino = 'img/';
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
require 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST" class="d-flex justify-content-center" enctype="multipart/form-data">
        <div class="d-flex justify-content-start">
            <input type="file" class="form-control" id="inputGroupFile04" name="miArchivo"
                aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            <button type="submit" class="m-1 btn btn-success">Enviar</button>
        </div>
    </form>
    <?php
                    $dire = "img/";
                    $escaner = scandir($dire);
                    $cont = 0;
                    foreach ($escaner as $clave) {
                        if ($clave != "." && $clave != "..") {
                        
                            echo '
                                <img src=' . $dire . $clave . '>
                                <form action="" method="POST">
            <input type="hidden" name="archivo" value="borar">
            <button class="btn btn-warning" type="submit">borar</button>
                </form>'
                                ;
                        }

                    }
                    ?>
</body>
</html>