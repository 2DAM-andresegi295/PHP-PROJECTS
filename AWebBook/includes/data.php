<?php
require 'conexion.php';
function getUsers($base_datos): array
{
	$sql = "SELECT * FROM usuarios;";
	$usuarios = mysqli_query($base_datos, $sql);

	$resultado = array();
	if ($usuarios && mysqli_num_rows($usuarios) >= 1) {
		while ($user = mysqli_fetch_assoc($usuarios)) {
			array_push($resultado, $user);
		}
	}
	return $resultado;
}
function getLibros($base_datos): array{
	
	$sql="SELECT * FROM libros;";
	$libros=mysqli_query($base_datos, $sql);

	$resultado=array();
	if($libros&&mysqli_num_rows($libros) >= 1){
		while($libro=mysqli_fetch_assoc($libros)){
			array_push($resultado,$libro);
		}
	}
	return $resultado;
}
function getCategoriaPorID($base_datos,$id_categoria){
	$sql='SELECT * FROM categorias 	WHERE id_categoria='.$id_categoria.';';
	$categorias=mysqli_query($base_datos, $sql);

	$array=array();

	if($categorias&&mysqli_num_rows($categorias)){
		while ($categoria=mysqli_fetch_assoc($categorias)) {
			array_push($array, $categoria);
		}
	}
	foreach($array as $valor){
		$resultado=$valor['nombre'];
	}
	return $resultado;
}
function getReservas($base_datos):array{

	$sql="SELECT * FROM reservas;";
	$reservas=mysqli_query($base_datos, $sql);

	$resultado=array();
	if($reservas&&mysqli_num_rows($reservas) >= 1){
		while ($reserva=mysqli_fetch_assoc($reservas)) {
			array_push($resultado, $reserva);
		}
	}
	return $resultado;
}
?>