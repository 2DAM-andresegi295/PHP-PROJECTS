<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "biblioteca_virtual";

// Crear conexión
$db = mysqli_connect($servidor, $usuario, $contraseña, $base_datos);
// Verificar conexión
if (!$db) {
    die("Conexión fallida: " . mysqli_connect_error());
}

?>