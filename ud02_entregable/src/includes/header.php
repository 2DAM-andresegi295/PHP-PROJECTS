
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
    <header class="d-flex justify-content-center bg-info">
        <h1 class="titulo"><img src="../src/img/logo-mm.png">Gestión de <?=$clase?></h1>
    </header>
    <div class="p-4">
        <ul class="nav nav-pills d-flex justify-content-center">
            <li class="nav-item">
                <a class="nav-link <?= $clase == "alumnos" ? "active" : " " ?>" aria-current="page"
                    href="index.php">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $clase == "profesores" ? "active" : " " ?>" href="profesores.php">Profesores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $clase == "altas" ? "active" : " " ?>" href="alta.php">Alta usuario</a>
            </li>
            <li class="nav-item">
                <a class="nav-link  <?= $clase == "galería" ? "active" : " " ?>" href="excursiones.php">Galería</a>
            </li>
        </ul>
    </div>
</body>

</html>