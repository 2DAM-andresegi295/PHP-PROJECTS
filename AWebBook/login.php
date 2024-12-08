<?php
session_start();
require './includes/data.php';
require './includes/header.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["logout"]) && isset($_POST["username"])) {

    $_SESSION['rol'] = "no";

    $username = $_POST["username"];
    $password = $_POST["password"];

    $array_usuarios = getUsers($db);

    $COINCIDE = false;
    foreach ($array_usuarios as $user) {
        if ($username == $user['nombre_usuario'] && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            if ($user['is_admin'] == 1) {
                $_SESSION['rol'] = "administrador";
            } else {
                $_SESSION['rol'] = "usuario";
            }
            $_SESSION['id_usuario'] = $user['id_usuario'];

            header("Location: index.php");
            exit();
        }else{
            $correcto=false;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <div class="container mt-5">

        <h1 class="text-center mb-4">Iniciar Sesión</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm">
                    <form action="login.php" method="POST">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["logout"]) && isset($_POST["username"])) {
                            if (!$correcto) {
                                echo '<div class="alert alert-danger" role="alert">
                                        Inicio de sesión erroneo
                                    </div>';
                            }
                        }
                        ?>
                        
                        <div class="mb-3">
                            <label for="username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Introduce tu nombre de usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Introduce tu contraseña" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                    </form>
                    <form action="registro.php" method="POST" class="d-flex justify-content-center m-2">
                        <button type="submit" class="btn btn-warning">Registrarme</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>