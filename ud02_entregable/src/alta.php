<?php
session_start();
$clase = "altas";
require 'includes/header.php';
if ($_SESSION['correo'] == '1234' && $_SESSION['contraseña'] == '1234') {

} else {
    header("Location: login.php");
}
$tipo = "no_usuario";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['tipo'])) {
        $tipo = $_GET['tipo'];
    }
    if ($tipo == "Elige") {
        echo '<div class="alert alert-danger d-flex justify-content-center" role="alert">
      El tipo de usuario seleccionado no es correcto
    </div>';
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['email'])) {
        $correo = $_POST['email'];

        $var = filter_var($correo, FILTER_VALIDATE_EMAIL);
        if ($var == false) {
            if (isset($_POST['cur-esp-1'])) {
                $tipo = $_POST['cur-esp-1'];
            }
            if (isset($_POST['cur-esp-2'])) {
                $tipo = $_POST['cur-esp-2'];
            }
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alta usuarios</title>
</head>

<body>
        <?= $tipo == "no_usuario" ? '<h1 class="d-flex justify-content-center">Alta usuarios</h1>' : '' ?>
        <?= $tipo == "profesor" ? '<h1 class="d-flex justify-content-center">Alta profesor</h1>' : '' ?>
        <?= $tipo == "alumno" ? '<h1 class="d-flex justify-content-center">Alta alumno</h1>' : '' ?>
    <div class="p-4">
        <form
            class="form-inline d-flex align-items-end <?= $tipo == "alumno" || $tipo == "profesor" ? "d-none" : " " ?>"
            method="GET" action="">
            <div class="col-md-6 col-12 ">
                <label for="inputState" class="form-label">Seleccione el tipo de usuarios que desea dar de alta:</label>
                <select name="tipo" id="inputState" class="form-select ">
                    <option value="Elige" selected>Elige...</option>
                    <option value="alumno">Alumno</option>
                    <option value="profesor">Profesor</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Crear</button>
        </form>

        <form method="post" class="row g-3 <?= $tipo == "alumno" || $tipo == "profesor" ? "" : " d-none" ?>">
            <div class="col-12 col-md-6">
                <label for="inputNombre" class="form-label">Nombre</label>
                <input required type="text" class="form-control" id="inputNombre" name="nombre">
            </div>
            <div class="col-12 col-md-6">
                <label for="inputApellidos" class="form-label">Apellidos</label>
                <input required type="text" class="form-control" id="inputApellidos" name="apellidos">
            </div>
            <div class="col-12 col-md-6">
                <label for="inputEmail" class="form-label"> Email</label>
                <input required type="text" class="form-control" id="inputEmail" name="email">
            </div>
            <div class="col-12 col-md-6">
                <label><?= $tipo == "alumno" ? " 2º DAM" : " " ?></label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cur-esp-1" id="radioMayorEdad"
                        value="<?= $tipo == "alumno" ? "alumno" : "profesor" ?>">
                    <label class="form-check-label" for="radioMayorEdad">
                        <?= $tipo == "alumno" ? " 1º DAM" : " " ?>
                        <?= $tipo == "profesor" ? " Comercio" : " " ?>
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="cur-esp-2" id="radioNoMayorEdad"
                        value="<?= $tipo == "alumno" ? "alumno" : "profesor" ?>""> 
                <label class=" form-check-label" for="radioNoMayorEdad">
                    <?= $tipo == "alumno" ? " 2º DAM" : " " ?>
                    <?= $tipo == "profesor" ? " Informática" : " " ?>
                    </label>
                </div>
            </div>
            <div class="d-flex justify-content-center"><button name="alta" class=" btn btn-success">Dar Alta</button>
            </div>
        </form>
    </div>




</body>

</html>