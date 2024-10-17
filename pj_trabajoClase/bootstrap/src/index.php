<?php
    $clase="inicio";
    require 'includes/header.php';

    $persona=array(
        "nombre"=>"maria",
        "apellido"=> "millan",
        "correo"=> "aaaa@gmail.com"
    );
    foreach($persona as $clave => $p) {
        echo $clave."-".$p."<br>";
    }

    $agenda=array(
        array(
        "nombre"=>"maria",
        "apellido"=> "millan",
        "correo"=> "aaaa@gmail.com"
        ),
        array(
            "nombre"=>"maria",
            "apellido"=> "millan",
            "correo"=> "aaaa@gmail.com"
        ),
        array(
            "nombre"=>"maria",
            "apellido"=> "millan",
            "correo"=> "aaaa@gmail.com"
        )
    );

    foreach($agenda as $clave => $valor) {

        echo $valor['nombre'].$valor['apellido'].$valor['correo']."<br>";

    }
?>


<h2>INDEX</h2>
</body>
</html>