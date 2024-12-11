<?php

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$baseDatos = "biblioteca_virtual";

// Crear conexión
$db = mysqli_connect($servidor, $usuario, $contraseña, $baseDatos);

// Verificar conexión
if (!$db) 
    die("Error en la conexión: " . mysqli_connect_error());

?>