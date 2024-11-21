<?php
require 'conexion.php';
function getTareas($db){
    $sql='SELECT id, titulo, descrpcion, fecha_entrega, estado FROM tareas t;';
    $tareas=mysqli_query($db, $sql);

    $resultado=array();
    if (mysqli_num_rows($tareas)>0) {
        while ($tarea=mysqli_fetch_assoc($tarea)) {
            array_push($resultado, $tarea);
        }
    }
    return $resultado;
}
?>
