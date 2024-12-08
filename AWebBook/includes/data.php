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
function getCategoria($base_datos): array{
	$sql='SELECT * FROM categorias;';
	$categorias=mysqli_query($base_datos, $sql);
	$array=array();

	if($categorias&&mysqli_num_rows($categorias)){
		while ($categoria=mysqli_fetch_assoc($categorias)) {
			array_push($array, $categoria);
		}
	}
	return $array;
}
function getCategoriaPorID($base_datos,$id_categoria){
	$sql='SELECT * FROM categorias 	WHERE id_categoria='.$id_categoria.';';
	$categorias=mysqli_query($base_datos, $sql);

	$array=array();
	$resultado=-1;

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
function hacerReserva( $id_usuario, $id_libro, $fecha_reserva, $base_datos){
	$check=false;
	$sqlInsert= "INSERT INTO reservas (id_usuario, id_libro, fecha_reserva) VALUES ('$id_usuario', '$id_libro', '$fecha_reserva');";
	$query = mysqli_query($base_datos, $sqlInsert);
	if ($query) {
		$check=true;
	}
	return $check;
}
function eliminarLibro($id_libro, $base_datos): bool{
	$check=false;
	$sql="DELETE FROM reservas WHERE id_libro = '$id_libro';";
	mysqli_query($base_datos, $sql);
	$sql="DELETE FROM libros WHERE id_libro = '$id_libro';";
	$query = mysqli_query($base_datos, $sql);
	if ($query) {
		$check=true;
	}
	return $check;
}
function insertarLibro($base_datos,$titulo, $autor, $id_categoria, $disponible, $imagen){
	$check=false;
	$sql="INSERT INTO libros (titulo, autor, id_categoria, disponible, imagen) VALUES ('$titulo', '$autor', '$id_categoria', '$disponible', '$imagen')";
	mysqli_query($base_datos, $sql);

	$query = mysqli_query($base_datos, $sql);
	if ($query) {
		$check=true;
	}
	return $check;
}

?>