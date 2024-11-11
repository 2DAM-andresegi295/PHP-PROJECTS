<?php
session_start();
$clase = "alta";
require 'includes/header.php';
if ($_SESSION['correo'] == '1234' && $_SESSION['contraseña'] == '1234') {

} else {
    header("Location: login.php");
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
    <h1 class="d-flex justify-content-center">Alta usuarios</h1>
    <form class="form-inline d-flex align-items-end" method="POST" action="">
        <div class="col-md-6 col-12 ">

            <label for="inputState" class="form-label">Seleccione el tipo de usuarios que desea dar de alta:</label>
            <select name="contacto" id="inputState" class="form-select ">
                <option selected>Elige...</option>
                <option value="alumno">Alumno</option>
                <option value="profesor">Profesor</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="crear">Crear</button>
    </form>

</body>

</html>