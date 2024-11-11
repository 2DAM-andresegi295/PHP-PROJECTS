<?php
$clase = "profesores";
session_start();

require 'includes/header.php';
if ($_SESSION['correo'] == '1234' && $_SESSION['contraseña'] == '1234') {

} else {
    header("Location: login.php");
}
?>
<?php
$profesores = array(
    array(
        "modulo" => "Informátia",
        "nombre" => "Eva",
        "correo" => "eeee@gmail.com"
    ),
    array(
        "modulo" => "Informátia",
        "nombre" => "María",
        "correo" => "aaa@gmail.com"
    ),
    array(
        "modulo" => "Comercio",
        "nombre" => "Carlos",
        "correo" => "cccccc@gmail.com"
    ),
    array(
        "modulo" => "Comercio",
        "nombre" => "Juan",
        "correo" => "jjj@gmail.com"
    )
);
if (isset($_POST['AZ'])) {
    sort($profesores);
}
if (isset($_POST['ZA'])) {
    rsort($profesores);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profesorado</title>
</head>

<body>
    <h1 class="d-flex justify-content-center">Profesorado</h1>
    <div class="d-flex justify-content-center p-3">
        <form method="POST">
            <button type="submit" name="AZ" class="m-1 btn btn-success">Ordenar A->Z</button>
            <button type="submit" name="ZA" class="m-1 btn btn-danger">Ordenar Z->A</button>
        </form>
    </div>
    

    <table class="d-flex justify-content-center">
        <tr>
            <?php
            foreach ($profesores as $clave => $valor) {
                echo '
                <td class="p-3">
                <div class="card border-primary" style="width: 18rem;">
                    <div class="card-header">
                        ' . $valor['modulo'] . '
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h3>' . $valor['nombre'] . '</h3>
                            <p>' . $valor['correo'] . '</p>
                        </li>

                    </ul>
                </td>';
            }
            ?>
        </tr>
    </table>


</body>

</html>