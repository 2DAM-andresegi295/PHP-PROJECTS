<?php
        $nombre_recibido= $_GET['nombre'];
        $apllidos_recibidos=$_GET['apellidos'];
        $edad_recibida= $_GET['edad'];
        echo 'Hola '.$nombre_recibido.' '.$apllidos_recibidos.'</br>';
        if ($edad_recibida>=18){
            echo 'Eres mayor de edad.';
        }else{echo'Eres menor de edad.';}
    ?>