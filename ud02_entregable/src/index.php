<?php
session_start();
$clase = "inicio";

if ($_SESSION['correo'] != '1234' || $_SESSION['contraseña'] != '1234') {
    header("Location: login.php");
    exit();
}

$alumnos = array(
    array(
        "id" => "000",
        "nombre" => "María",
        "correo" => "aaaa@gmail.com",
        "curso" => "1º DAM"
    ),
    array(
        "id" => "001",
        "nombre" => "Juan",
        "correo" => "jjjj@gmail.com",
        "curso" => "2º DAM"
    ),
    array(
        "id" => "002",
        "nombre" => "Eva",
        "correo" => "eeee@gmail.com",
        "curso" => "2º DAM"
    ),
    array(
        "id" => "003",
        "nombre" => "Carlos",
        "correo" => "cccc@gmail.com",
        "curso" => "1º DAM"
    )
);

function crearArchivoDescargable($rutaArchivo, $contenido) {
    file_put_contents($rutaArchivo, $contenido);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($rutaArchivo) . '"');
    readfile($rutaArchivo);
    unlink($rutaArchivo); 
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['archivo'])) {
    $nombre_archivo = './files/' . basename($_GET['archivo']);
    $contenido = "";
    foreach ($alumnos as $valor) {
        $contenido .= "{$valor['nombre']} {$valor['correo']} {$valor['curso']}" . PHP_EOL;
    }
    crearArchivoDescargable($nombre_archivo, $contenido);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['alumno_id'])) {
    $alumno_id = $_GET['alumno_id'];
    foreach ($alumnos as $valor) {
        if ($valor['id'] == $alumno_id) {
            $nombre_archivo = './files/' . $alumno_id . '.txt';
            $contenido = "{$valor['id']} {$valor['nombre']} {$valor['correo']} {$valor['curso']}" . PHP_EOL;
            crearArchivoDescargable($nombre_archivo, $contenido);
        }
    }
}
require 'includes/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnado</title>
    <style>
        .texto-rojo { color: red; }
        .texto-verde { color: green; }
    </style>
</head>
<body>
    <h1 class="d-flex justify-content-center">Alumnado</h1>
    <div class="m-4">
        <form method="POST" action="">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre del alumno a buscar:</label>
                <input type="text" name="name" class="form-control" placeholder="Ej: Andrés">
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $buscar = $_POST['name'];
                    $encontrado = false;
                    foreach ($alumnos as $valor) {
                        if ($buscar == $valor['nombre']) {
                            $encontrado = true;
                            break;
                        }
                    }
                    echo $encontrado ? '<h3 class="texto-verde">Alumn@ ' . $buscar . ': está en la lista</h3>' : '<h3 class="texto-rojo">Alumn@ ' . $buscar . ': no está en la lista</h3>';
                }
            ?>
        </form>
        <form class="d-flex justify-content-end" action="" method="get">
            <input type="hidden" name="archivo" value="alumnos.txt">
            <button class="btn btn-warning" type="submit">Descargar todo</button>
        </form>
        <table class="table table-hover">
            <tr class="fw-bold">
                <td>Nombre</td>
                <td>Correo</td>
                <td>Curso</td>
                <td>Detalle</td>
            </tr>
            <?php
            foreach ($alumnos as $valor) {
                echo '
                <tr>
                    <td>' . $valor['nombre'] . '</td>
                    <td>' . $valor['correo'] . '</td>
                    <td>' . $valor['curso'] . '</td>
                    <td>
                        <form action="" method="get">
                            <input type="hidden" name="alumno_id" value="' . $valor['id'] . '"/>
                            <button type="submit" class="btn btn-light"><img src=".\img\download.svg"></button>
                        </form>
                    </td>
                </tr>';
            }
            ?>
        </table>
    </div>
</body>
</html>
