<?php
session_start();
$clase = "inicio";
require 'includes/header.php';
if ($_SESSION['correo'] == '1234' && $_SESSION['contraseña'] == '1234') {

} else {
    header("Location: login.php");
}
?>
<?php
$alumnos = array(
    array(
        "nombre" => "María",
        "correo" => "aaaa@gmail.com",
        "curso" => "1º DAM"
    ),
    array(
        "nombre" => "Juan",
        "correo" => "jjjj@gmail.com",
        "curso" => "2º DAM"
    ),
    array(
        "nombre" => "Eva",
        "correo" => "eeee@gmail.com",
        "curso" => "2º DAM"
    ),
    array(
        "nombre" => "Carlos",
        "correo" => "cccc@gmail.com",
        "curso" => "1º DAM"
    )
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alumnado</title>
    <style>
    .texto-rojo {color: red; }
    .texto-verde{color: green;}
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
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $buscar=$_POST['name'];
                $encontrado=0;
                foreach ($alumnos as $clave => $valor) {
                    $nombre = $valor['nombre'];
                    if($buscar==$nombre){
                        $encontrado=1;
                    }
                }
                if($encontrado==1){
                    echo '<h3 class="texto-verde">Alumn@'.$buscar.': está en la lista</h3>';
                }else{
                    echo '<h3 class="texto-rojo">Alumn@ '.$buscar.': no está en la lista</h3>';
                }
            }
        ?>
    </form>
    <form class="d-flex justify-content-end" action="" method="get">
        <input type="hidden" name="archivo" value="./files/alumnos.txt">
        <button class="btn btn-warning" type="submit">Descargar todo</button>
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET['archivo'])){
                $nombre_archivo=$_GET['archivo'];
                $archivo = fopen($nombre_archivo, "w");
                if($archivo){
                    foreach ($alumnos as $clave => $valor) {
                        $nombre = $valor['nombre'];
                        $correo = $valor['correo'];
                        $curso = $valor['curso'];
                        $linea = "$nombre $correo $curso";
                        fwrite($archivo, $linea . PHP_EOL);
                    }
                    fclose($archivo);
                }
                $use=false;
                $context=null;
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($nombre_archivo) . '"');

                readfile($nombre_archivo);
            }
            
        }
    ?>

    <table class="table table-hover">
        <tr class="fw-bold">
            <td>Nombre</td>
            <td>Correo</td>
            <td>Curso</td>
        </tr>
        <?php
        foreach ($alumnos as $clave => $valor) {
            $nombre = $valor['nombre'];
            $correo = $valor['correo'];
            $curso = $valor['curso'];
            echo "
            <tr>
                <td>
                    $nombre
                </td>
                <td>
                    $correo
                </td>
                <td>
                    $curso
                </td>
            </tr>";
        }
        ?>
    </table>
    </div>
</body>

</html>