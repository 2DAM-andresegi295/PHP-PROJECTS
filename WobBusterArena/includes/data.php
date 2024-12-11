<?php
require 'conexion.php';
function getUsers($db){
    $sql = "SELECT id_usuario, nombre, email , password, rol  FROM usuarios;";
    $usuarios = mysqli_query($db, $sql);

    $resultado = array();
	if ($usuarios && mysqli_num_rows($usuarios) >= 1) {
		while ($user = mysqli_fetch_assoc($usuarios)) {
			array_push($resultado, $user);
		}
	}

	return $resultado;
}
function getCompeticiones($db){
    $sql = "SELECT *  FROM campeonatos;";
    $campeonatos = mysqli_query($db, $sql);
    $resultado = array();
    if ($campeonatos && mysqli_num_rows($campeonatos) >= 1) {
        while ($campeonato = mysqli_fetch_assoc($campeonatos)) {
            array_push($resultado, $campeonato);
        }
    }
    return $resultado;
}
function nuevaCompeticion($db,$nombre, $fecha, $ciudad, $provincia, $precio, $imagen, $cerrado){
    $sql ="INSERT INTO campeonatos (nombre, fecha, ciudad, provincia, precio, imagen, cerrado)
     VALUES ($nombre, $fecha, $ciudad, $provincia, $precio, $imagen, $cerrado)";
    
    return mysqli_query($db, $sql);
}
function getInscripciones($db){
    $sql = "SELECT *  FROM campeonatos;";
    $inscripciones=mysqli_query($db, $sql);
    $resultado = array();
    if ($inscripciones && mysqli_num_rows($inscripciones) >= 1) {
        while ($campeonato = mysqli_fetch_assoc($inscripciones)) {
            array_push($resultado, $campeonato);
        }
    }
    return $resultado;
}
?>