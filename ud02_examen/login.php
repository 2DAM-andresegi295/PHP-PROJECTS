<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$login = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['usuario'] = $_POST['usuario'];
    $_SESSION['contraseña'] = $_POST['contrasena'];
    $_SESSION['rep_contrasena'] = $_POST['rep_contrasena'];

    if ($_SESSION['usuario'] == '1234' && $_SESSION['contraseña'] == '1234' && $_SESSION['rep_contrasena'] == '1234') {
        header("Location: index.php");
    } else {
        $login = false;
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</head>

<body>
    <h1 class="d-flex justify-content-center pt-5 ">Iniciar Sesión</h1>
    <div class="container d-flex justify-content-center">
        <form class="card p-4" method="POST" action="">
            <div class="justify-content-center">
                <label for="correo" class="form-label">Nombre de usuario</label>
                <input type="text" class="form-control" aria-describedby="emailHelp" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="text" class="form-control" name="contrasena" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Repetir la contraseña</label>
                <input type="text" class="form-control" name="rep_contrasena" required>
            </div>
            <?= !$login ? '<div class="alert alert-danger d-flex justify-content-center" role="alert">
                Login incorrecto
                </div>' : " " ?>
            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</body>

</html>

