<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cerrar_sesion'])) {
    var_dump($_SESSION['usuario']);
    $_SESSION['usuario'] = '1';
    $_SESSION['contraseña'] = '1';
    $_SESSION['rep_contrasena'] = '1';
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <header class="bg-info">
        <div class="col-md-4 offset-md-8">
            <form method="POST" action="">
                <input type="hidden" name="cerrar_sesion" value="cerrar_sesion">
                <button type="submit" class="btn btn-dark ">Cerrar sesión</button>
            </form>
        </div>
        <div class="col-md-4 offset-md-4">
            <h1 class="titulo"><img src="..\ud02_examen\resources\logo_eventos.png">PlanificaT</h1>
        </div>
    </header>
    <div class="p-4">
        <ul class="nav nav-pills d-flex justify-content-center">
            <li class="nav-item">
                <a class="nav-link <?= $clase == "Eventos" ? "active" : " " ?>" aria-current="page"
                    href="index.php">Eventos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $clase == "Galería" ? "active" : " " ?>" href="galeria.php">Galería</a>
            </li>
        </ul>
    </div>
</body>

</html>