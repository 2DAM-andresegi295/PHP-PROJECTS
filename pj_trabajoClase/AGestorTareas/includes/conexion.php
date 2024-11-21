<?php
$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "gestion";

$db= mysqli_connect($servidor, $usuario, $contraseña, $base_datos);

if (!$db) {
    die("Conexion fallida" .mysqli_connect_error());
}else{
    echo "Funciona";
}
?>