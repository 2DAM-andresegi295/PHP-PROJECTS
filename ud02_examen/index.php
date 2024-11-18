<?php
session_start();
$clase = "Eventos";

if ($_SESSION['usuario'] != '1234' && $_SESSION['contraseña'] != '1234' && $_SESSION['rep_contrasena'] != '1234') {
    header("Location: login.php");
    exit();
}

$eventos = array(
    array(
        "fecha" => "2024-12-15",
        "id" => "000",
        "nombre" => "Boda de Ana y Luis",
        "ubicacion" => "Madrid",
        "descripcion" => "Ceremonia en el parque central con una recepción al aire libre en un jardín privado.",
        "fotografo" => "Sí",
        "pagado" => "Sí"
    ),
    array(
        "fecha" => "2024-12-20",
        "id" => "001",
        "nombre" => "Aniversario de Carla y Jorge",
        "ubicacion" => "Sevilla",
        "descripcion" => "Celebración en la playa con temática tropical y cena bajo las estrellas.",
        "fotografo" => "No",
        "pagado" => "Sí"
    ),
    array(
        "fecha" => "2024-10-10",
        "id" => "002",
        "nombre" => "Fiesta de Compromiso de Marta y José",
        "ubicacion" => "Sevilla",
        "descripcion" => "Evento íntimo en una terraza con vista al mar, decorado con luces cálidas.",
        "fotografo" => "Sí",
        "pagado" => "Sí"
    ),
    array(
        "fecha" => "2025-01-22",
        "id" => "003",
        "nombre" => "Boda de Claudia y Pablo",
        "ubicacion" => "Barcelona",
        "descripcion" => "Boda en un salón elegante con una ceremonia civil y recepción con cena formal.",
        "fotografo" => "Sí",
        "pagado" => "Sí"
    ),
    array(
        "fecha" => "2024-12-23",
        "id" => "004",
        "nombre" => "Cena de Navidad de la Empresa XYZ",
        "ubicacion" => "Madrid",
        "descripcion" => "Una cena formal para los empleados de XYZ en un restaurante exclusivo con temática navideña.",
        "fotografo" => "No",
        "pagado" => "Sí"
    ),
    array(
        "fecha" => "2024-12-23",
        "id" => "005",
        "nombre" => "Baby Shower de Sara",
        "ubicacion" => "Granada",
        "descripcion" => "Celebración de bienvenida para el bebé de Sara, con decoración temática y actividades familiares.",
        "fotografo" => "No",
        "pagado" => "No"
    )
);

function crearArchivoDescargable($rutaArchivo, $contenido)
{
    file_put_contents($rutaArchivo, $contenido);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($rutaArchivo) . '"');
    readfile($rutaArchivo);
    unlink($rutaArchivo);
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['archivo'])) {
    $archivo = $_POST['archivo'];
    foreach ($eventos as $valor) {
        if ($valor['id'] == $archivo) {
            $nombre_archivo = './files/' . $archivo . '.txt';
            $contenido = "{$valor['id']} {$valor['nombre']} {$valor['ubicacion']} {$valor['descripcion']} {$valor['pagado']} {$valor['fotografo']} {$valor['fecha']}" . PHP_EOL;
            crearArchivoDescargable($nombre_archivo, $contenido);
        }
    }
}

$ciudad = 'Elige';
$pagado = 'Elige';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['ciudad'])) {
        $ciudad = $_POST['ciudad'];
    }
    if (isset($_POST['pagado'])) {
        $pagado = $_POST['pagado'];
    }
    if (isset($_POST['limpiar'])) {
        $ciudad = 'Elige';
        $pagado = 'Elige';
    }

}
require 'includes/header.php';
sort($eventos);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .texto-rojo {
            color: red;
        }

        .texto-verde {
            color: green;
        }
    </style>
</head>

<body>
    <form method="POST" action="">
        <div class="d-flex justify-content-center">
            <select name="ciudad" class="form-select m-1">
                <option value="Elige" selected>Elige la ciudad...</option>
                <option value="Madrid">Madrid</option>
                <option value="Sevilla">Sevilla</option>
                <option value="Barcelona">Barcelona</option>
                <option value="Granada">Granada</option>
            </select>
            <select name="pagado" class="form-select m-1">
                <option value="Elige" selected>Selecione si está pagado...</option>
                <option value="Sí">Sí</option>
                <option value="No">No</option>
            </select>
        </div>
        <div class="d-flex justify-content-center ">
            <button type="submit" class="btn btn btn-success m-1">Buscar</button>
            <form action="" method="POST">
                <input type="hidden" name="archivo" value="limpiar">
                <button class="btn btn-warning" type="submit">Limpiar</button>
            </form>
        </div>
    </form>



    <div class="p-4">
        <div class="d-flex justify-content-center">
            <table>
                <tr>
                    <?php
                    $contador = 0;
                    foreach ($eventos as $valor) {
                        $contador = $contador + 1;

                        if ($contador % 3 == 1) {
                            echo '<tr>';
                        }
                        if (($ciudad == $valor['ubicacion'] || $ciudad == 'Elige') && ($pagado == $valor['pagado'] || $pagado == 'Elige'))
                            echo '<td><div class="card">
                        <div class="card-header">
                            ' . $valor['nombre'] . '
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">' . $valor['ubicacion'] . '</h5>
                            <h5 class="card-title">' . $valor['fecha'] . '</h5>
                            <p class="card-text">' . $valor['descripcion'] . '</p>

                            <form class="d-flex justify-content-end" action="" method="POST">
                                <input type="hidden" name="archivo" value="' . $valor['id'] . '">
                                <button class="btn btn-warning" type="submit">Detalles</button>
                            </form>
                        </div>
                    </div></td>';
                        if ($contador % 3 == 0) {
                            echo '</tr>';
                        }
                    }
                    ?>
                </tr>
            </table>
        </div>


    </div>
</body>

</html>