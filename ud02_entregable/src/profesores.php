<?php
    $clase="profesores";
    session_start();
    
    require 'includes/header.php';
    if($_SESSION['correo']== '1234'&& $_SESSION['contraseña']== '1234')
    {
        
    }else{header("Location: login.php");}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1 class="d-flex justify-content-center">Profesores</h1>
</body>
</html>