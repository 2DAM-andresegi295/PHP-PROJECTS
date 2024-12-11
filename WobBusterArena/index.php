<!DOCTYPE html>
<html lang="en">

</html>
<?php
require './includes/data.php';
require './includes/header.php';
$campeonatos = getCompeticiones($db);

$contador = 0;
?>
 <?= isset($_SESSION['rol']) == "administrador" ? '<button  type="submit" class="btn btn-primary w-25 m-1">Añadir usuario</button>': "" ?>

<form class="col-8 d-flex" method="GET">
            <select class="form-select w-75" name="categoriaEscogida">
                <option value="-1" selected>Filtrar por...</option>
                <?= $_SESSION['rol'] == "atleta"? '<option value="atleta">Mis competiciones</option>' : ""?>
                <option value="cerrado">Registro Cerrado</option>
                <option value="abierto">Registro abierto</option>
            </select>

            <select class="form-select w-75" name="categoriaEscogida">
                <option value="-1" selected>Provincia...</option>
                <option value="cerrado">Greanada</option>
                <option value="abierto">Sevilla</option>
                <option value="abierto">Madrid</option>
            </select>
            <input type="submit" class='btn btn-success active' name="filtrado" value="Filtar">
            <input type="submit" class='btn btn-danger active' name="filtrado" value="Limpiar">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET["filtrado"])) {
    if ($_GET['filtrado'] == 'Filtrar') {
        $categoria_filtrada = $_POST['categoria'];
    }

}
foreach ($campeonatos as $campeonato) {

    echo '<div class="col-md-4 d-flex align-items-stretch pb-1">
    <div class="card shadow">
        <img src="./img/' . $campeonato['imagen'] . '" class="img-thumbnail w-50" alt="">
        <div class="card-body d-flex flex-column">
            <h5 class="card-title">' . $campeonato['nombre'] . '</h5>
            <p class="card-text">
                <strong>Fecha:</strong> ' . $campeonato['fecha'] . '<br>
                <strong>Lugar: </strong>' . $campeonato['ciudad'] . '<br>
                <strong>Precio: </strong>' . $campeonato['precio'] . '€<br>
            </p>
            <div class="mt-auto">
                <form action="" method="POST">
                <input type="hidden" name="reserva" value="">';
    if ($campeonato['cerrado'] == 1) {//Si está cerrado
        echo '<button disable type="submit" class="btn btn-info w-50 m-1">Inscribirse</button>
                        <button disable type="submit" class="btn btn-primary w-50 m-1">Registro cerrado</button>
                </form>
                </div>
            </div>
        </div>
        </div>';
    } else {
        echo '<button  type="button" class="btn btn-info w-50 m-1" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Inscribirse</button>
                        <button disable class="btn btn-primary w-50 m-1">Registro abierto</button>
                </form>
                </div>
            </div>
        </div>
        </div>';
    }
    ;
}
?>



<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">¡¡¡ALERTA!!!</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Debe registrarse
            </div>
        </div>
    </div>
</div>