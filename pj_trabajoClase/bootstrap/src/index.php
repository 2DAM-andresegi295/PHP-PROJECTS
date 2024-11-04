<?php
$clase = "inicio";
require 'includes/header.php';

$persona = array(
    "nombre" => "maria",
    "apellido" => "millan",
    "correo" => "aaaa@gmail.com"
);
foreach ($persona as $clave => $p) {
    echo $clave . "-" . $p . "<br>";
}

$agenda = array(
    array(
        "nombre" => "maria",
        "apellido" => "millan",
        "correo" => "aaaa@gmail.com"
    ),
    array(
        "nombre" => "maria",
        "apellido" => "millan",
        "correo" => "aaaa@gmail.com"
    ),
    array(
        "nombre" => "maria",
        "apellido" => "millan",
        "correo" => "aaaa@gmail.com"
    )
);

foreach ($agenda as $clave => $valor) {

    echo $valor['nombre'] . $valor['apellido'] . $valor['correo'] . "<br>";

}
?>


<h2>INDEX</h2>
<div class="container">
    <div class="row">
        <?php
        $directorio = "./img/";
        $dir = scandir("./img/");
        foreach ($dir as $file) {
            $extension = pathinfo($file, PATHINFO_EXTENSION);
            if ($extension == "jpg" || $extension == "jpeg") {
                $ruta = $directorio . $file;
                echo "  <div class = col-3>
                                    <img src=$ruta>
                                </div>";
            }
        }
        ?>
    </div>
    <div>
        <?php
            $archivo=fopen("./img/datos.txt", "a");
            if($archivo){
                $bytes = fputs($archivo, "Hola PHP");
                echo "Bytes escritos: $bytes";
                fclose($archivo);
            }else{
                echo "No se pudo abrir el archivo";
            }
        ?>
    </div>
</div>
</body>

</html>