<?php
    $numero=$_GET['numero'];
    if ($numero>0) {        
        echo'El número es positivo.';
    }elseif ($numero< 0) {
        echo 'El número es negativo.';
    }elseif ($numero== 0) {
        echo 'El número es cero';
    }else{echo 'No es un número';}
?>