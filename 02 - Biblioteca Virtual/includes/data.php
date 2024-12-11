<?php
require 'conexion.php';

// RECOGE TODOS LOS USUARIOS DISPONIBLES DE LA TABLA "USUARIOS"
function getUsers($db){
	$sql = "SELECT id_usuario, nombre_usuario AS usuario, password, is_admin FROM usuarios;";
	$usuarios = mysqli_query($db, $sql);

	$resultado = array();
	if ($usuarios && mysqli_num_rows($usuarios) >= 1) {
		while ($user = mysqli_fetch_assoc($usuarios)) {
			array_push($resultado, $user);
		}
	}

	return $resultado;
}

/* Busca los libros disponibles según si la categoría se ha establecido
en el filtro o no. Si no se ha establecido devuelve todos los libros,
y si se ha seleccionado una categoría solo mostrará aquella. */
function getLibros($db, $nombreCategoria = null) {
	$sql = $nombreCategoria != null ?
    "SELECT id_libro, titulo, autor, disponible, imagen, nombre AS categoria
    FROM libros l JOIN categorias c ON l.id_categoria = c.id_categoria 
    WHERE c.nombre = '$nombreCategoria';"
	:
    "SELECT id_libro, titulo, autor, disponible, imagen, nombre AS categoria
    FROM libros l JOIN categorias c ON l.id_categoria = c.id_categoria ";

	$libros = mysqli_query($db, $sql);
	
	$resultado = array();
	if ($libros && mysqli_num_rows($libros) >= 1) {
		while ($libro = mysqli_fetch_assoc($libros)) 
			array_push($resultado, $libro);  
	}	

	return $resultado;
}

/* Recoje las reservas registradas actualmente. Si el valor $nombreUsuario es nulo,
significa que es un administrador y que devolverá todas las reservas sin importar
el usuario. En caso de que esté establecido, solo devolverá las de dicho usuario. */
function getReservas($db, $nombreUsuario = null) {
	$sql = $nombreUsuario != null ?
	"SELECT l.id_libro, l.titulo, r.fecha_reserva
    FROM libros l JOIN reservas r ON l.id_libro = r.id_libro 
	JOIN usuarios u ON r.id_usuario = u.id_usuario
    WHERE u.nombre_usuario = '$nombreUsuario';"
	:
	"SELECT u.nombre_usuario AS usuario, u.email, l.titulo
    FROM libros l JOIN categorias c ON l.id_categoria = c.id_categoria
	JOIN reservas r ON l.id_libro = r.id_libro
	JOIN usuarios u ON r.id_usuario = u.id_usuario";

	$reservas = mysqli_query($db, $sql);
	
	$resultado = array();
	if ($reservas && mysqli_num_rows($reservas) >= 1) {
		while ($reserva = mysqli_fetch_assoc($reservas)) 
			array_push($resultado, $reserva);  
	}	

	return $resultado;
}

/* Obtiene la última ID registrada, la aumenta por uno, 
e inserta dichos datos dependiendo de si se ha enviado una imagen o no. */
function insertarLibro($db, $titulo, $autor, $idCategoria, $disponibilidad, $imagen) {
	$sql = "SELECT MAX(id_libro) FROM libros";

	$resultado = mysqli_query($db, $sql);
	$idOrdenada = $resultado->fetch_row()[0];
	$idOrdenada += 1;

	$sql = !empty($imagen) ?
	"INSERT INTO libros (id_libro, titulo, autor, id_categoria, disponible, imagen)
	VALUES ($idOrdenada, '$titulo', '$autor', $idCategoria, $disponibilidad, '$imagen')"
	:
	"INSERT INTO libros (id_libro, titulo, autor, id_categoria, disponible, imagen)
	VALUES ($idOrdenada, '$titulo', '$autor', $idCategoria, $disponibilidad, 'default.png')";

	return mysqli_query($db, $sql);
}

/* 
1 -> Recoje la última ID registrada en reservas y la aumenta por uno.
2 -> Recoje el ID del usuario dependiendo del nombre enviado.
3 -> Añade el tiempo actual a la fecha de reserva, convirtiéndola
en formato DateTime y formateándola de vuelta a texto.
4 -> Introduce la reserva con los datos asignados
5 -> Deshabililta la disponibilidad del libro
*/
function reservarLibro($db, $nombreUsuario, $idLibro, $fechaReserva) {
	$sql = "SELECT MAX(id_reserva) FROM reservas";

	$resultado = mysqli_query($db, $sql);
	$siguienteIDReserva = $resultado->fetch_row()[0];
	$siguienteIDReserva += 1;

	$sql = "SELECT id_usuario, nombre_usuario FROM usuarios WHERE nombre_usuario = '$nombreUsuario'";

	$resultado = mysqli_query($db, $sql);
	$idUsuario = $resultado->fetch_row()[0];

	$fechaReserva .= " " . date('H:i:s');
	$format = 'Y-m-d H:i:s';
	$fechaReserva = DateTime::createFromFormat($format, $fechaReserva);
	$fechaReserva = $fechaReserva->format($format);

	$sql = "INSERT INTO reservas (id_reserva, id_usuario, id_libro, fecha_reserva) 
	VALUES ($siguienteIDReserva, $idUsuario, $idLibro, '$fechaReserva');";
	mysqli_query($db, $sql);

	$sql = "UPDATE libros SET disponible = 0 WHERE id_libro = $idLibro;";
	mysqli_query($db, $sql);
}

// Elimina el libro solicitado del registro
function eliminarLibro($db, $idLibro) {
	$sql = "DELETE FROM libros WHERE id_libro = $idLibro;";
	mysqli_query($db, $sql);
}

?>