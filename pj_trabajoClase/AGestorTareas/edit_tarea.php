<?php
require './includes/data.php';
require './includes/header.php';

// Verificar si el usuario está logueado, de lo contrario redirigir a login.php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$tarea_editar=[];
if (isset($_POST['tarea_id'])) {
    $id_tarea = $_POST['tarea_id'];
    $id_user = $_SESSION['id_user'];   
    $tarea_editar = getTareas($db, $id_user, $id_tarea);
} else {
    header('index.php');
}

if (isset($_POST['guardarCambios'])) {
    //Recogemos toda la información de las tareas del formulario.
    $id_tarea = $_POST['id_tarea'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $estado = $_POST['estado'];
    $id_user = $_SESSION['id_user'];

    $check_update=guardarCambiosTarea($db, $id_tarea,$titulo,  $descripcion,  $fecha_entrega, $estado, $id_user);

    if($check_update){
        header('Location: index.php');
    }
}

?>

<body>
    <div class="d-flex justify-content-end m-2">
        <form action="index.php" method="post"> 
            <button type="submit" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>

    <form id="editTarea" method="post" action="" class="p-3 border rounded shadow bg-white">
        <input type="hidden" name="id_tarea" value="<?= $tarea_editar[0]['id']; ?>">

        <!-- Campo de Título -->
        <div class="mb-3">
            <label for="titulo" class="form-label fw-bold">Título</label>
            <input type="text" class="form-control form-control-lg" id="titulo" name="titulo"
                value="<?= $tarea_editar[0]['titulo']; ?>" placeholder="Escribe el título de la tarea" required>
        </div>

        <!-- Campo de Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label fw-bold">Descripción</label>
            <textarea class="form-control form-control-lg" id="descripcion" name="descripcion" rows="4"
                placeholder="Describe la tarea" required><?= $tarea_editar[0]['descripcion'];  ?></textarea>
        </div>

        <!-- Campo de Fecha de Entrega -->
        <div class="mb-3">
            <label for="fecha_entrega" class="form-label fw-bold">Fecha de Entrega</label>
            <input type="date" class="form-control form-control-lg" id="fecha_entrega" name="fecha_entrega"
                value="<?= $tarea_editar[0]['fecha_entrega']; ?>" required>
        </div>

        <!-- Campo de Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label fw-bold">Estado</label>
            <select class="form-select form-select-lg" id="estado" name="estado" required>
                <option value="to_do" <?= $tarea_editar[0]['estado'] === 'to_do' ? 'selected' : ''; ?>>Pendiente</option>
                <option value="doing" <?= $tarea_editar[0]['estado'] === 'doing' ? 'selected' : ''; ?>>En progreso</option>
                <option value="done" <?=$tarea_editar[0]['estado'] === 'done' ? 'selected' : ''; ?>>Completada</option>
            </select>
        </div>

        <!-- Botones -->
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" name="guardarCambios" class="btn btn-primary">Guardar Cambios</button>

        </div>
    </form>
</body>