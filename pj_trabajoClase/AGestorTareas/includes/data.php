<?php
require 'conexion.php';

function getTareas($db, $id_user=null){
    $sql = $id_user!=null?
	"SELECT id, titulo, descripcion, fecha_entrega, estado FROM tareas t WHERE t.usuario_id='$id_user'"
	:
	"SELECT id, titulo, descripcion, fecha_entrega, estado FROM tareas t;";

	$tareas = mysqli_query($db, $sql);
	
	$resultado = array();

	if($tareas && mysqli_num_rows($tareas) >= 1){
		while ($tarea = mysqli_fetch_assoc($tareas)) {

				array_push($resultado, $tarea);
                
		}		
	}	
	return $resultado;

}

function guardarNuevoUsuario($nombre, $email, $password, $db){
	$password_segura=password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
	password_verify($password, $password_segura);

	$sqlinsert="INSERT INTO usuarios (nombre, email, contraseña) VALUES ('$nombre', '$email', '$password_segura')";
	$quuery=mysqli_query($db, $sqlinsert);

	if($quuery){
		$_SESSION['registro']=true;
	}else{
		$_SESSION['registro']=false;
	}

	return $_SESSION['registro'];
}

function getUsers($db){
	//TO DO
	$sql="SELECT id, nombre, email, contraseña FROM usuarios;";
	$usuarios=mysqli_query($db,$sql);
	$resultado=array();
	if($usuarios && mysqli_num_rows($usuarios)>=1){
		while($user=mysqli_fetch_assoc($usuarios)){
			array_push($resultado,$user);
		}
	}
	return $resultado;
}


function insertarTarea($db, $titulo, $descripcion, $fecha_entrega, $estado, $id_user)
{
	$check=false;
	$sqlInsert="INSERT INTO tareas (usuario_id, titulo, descripcion, fecha_entrega, estado)
			VALUES ('$id_user','$titulo', '$descripcion', '$fecha_entrega', '$estado')";
	
	$query=mysqli_query($db, $sqlInsert);
}

function guardarCambiosTarea($db, $id_tarea, $titulo,  $descripcion,  $fecha_entrega, $estado, $id_user){
	//TO DO
	$check=false;
	$sqlInsert="UPDATE tareas SET
	titulo= '$titulo';
	descripcion='$descripcion'
	fecha_entrega='$fecha_entrega'
	estado='$estado'
	WHERE id='$id_tarea' AND usuario_id='$$id_user'";

	$query=mysqli_query($db, $sqlInsert);
	if($query){
		$check=true;
	}
	return $check;
}

function eliminarTarea($db, $id_tarea){

	$check=false;

	$sqlInsert="DELETE FROM tareas WHERE id='$id_tarea'";

	$query=mysqli_query($db, $sqlInsert);

	if($query){
		$check=true;
	}
	return $check;
}

?>
