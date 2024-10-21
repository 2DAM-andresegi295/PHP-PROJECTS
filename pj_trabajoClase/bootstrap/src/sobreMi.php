<?php
    $clase="sobreMi";
    require 'includes/header.php';

    $agenda=array(
        array(
        "nombre"=>"Fútbol",
        "descripcion"=> "Jugar al futbol con amigos",
        "imagen"=> "./img/futbol.jpg",
        "veces_semana"=>"3"
        ),
        array(
            "nombre"=>"Baloncesto",
            "descripcion"=> "Meter pelota en la canasta",
            "imagen"=> "./img/baloncesto.jpeg",
            "veces_semana"=>"2"
        ),
        array(
            "nombre"=>"Ciclismo",
            "descripcion"=> "Montar en bicicleta por el campo",
            "imagen"=> "./img/ciclismo.jpg",
            "veces_semana"=>"4"
        )
    );

    function array_orderby($arrayToOrder, $field) {
        $columna=array_column($arrayToOrder, $field);

        array_multisort($columna, SORT_ASC,  $arrayToOrder);
        return $arrayToOrder;
    }

    $agendas_or=array_orderby($agenda,"veces_semana")

?>
<div class="container">
    <h1 class="text-center mb-4"></h1>
    <div class="row">
        <?php
            foreach($agendas_or as $clave) {
                //echo $clave["nombre"]."<br>";
                $nombre=$clave["nombre"];
                $descripcion=$clave["descripcion"];
                $veces=$clave['veces_semana'];
                $imagen=$clave["imagen"];
                echo "<div class='col-12 col-md-4'>
                <div class='card' style='width: 18rem;'>
                <img src='$imagen' class='card-img-top' alt='...'>
                <div class='card-body'>
                  <h5 class='card-title'>$nombre</h5>
                  <p class='card-text'>$descripcion</p>
                  <a href='#' class='btn btn-primary'>$veces</a>
                </div>
              </div>
              </div>";
            }
        ?>
    </div>
</div>