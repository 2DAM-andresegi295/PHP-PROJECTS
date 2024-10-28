<?php
    $clase="contacto";
    require 'includes/header.php';
?>
<h2>CONTACTO</h2>
<form action="" method="post" class="row g-3">
    <div class="col-12 col-md-6">
        <label for="inputNombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="inputNombre" name="nombre">
    </div>
    <div class="col-12 col-md-6">
        <label for="inputApellidos" class="form-label">Apellidos</label>
        <input type="text" class="form-control" id="inputApellidos" name="apellidos">
    </div>
    <div class="col-12 col-md-6">
        <label for="inputEmail" class="form-label"> Email</label>
        <input type="text" class="form-control" id="inputEmail" name="email">
    </div>
    <div class="col-md-6 col-12">
        <div class="row p-2">
            <label>Indica si eres mayor de edad</label>
            <div class="col-6 form-check">
                <input class="form-check-input" type="radio" name="radioMayorEdad" id="radioMayor Edad" value="simayor">
                <label class="form-check-label" for="radioMayorEdad">
                    Sí, soy mayor de edad
                </label>
            </div>
            <div class="col-6 form-check">
                <input class="form-check-input" type="radio" name="radioMayorEdad" id="radioNoMayorEdad" value="nomayor"
                    checked> <label class="form-check-label" for="radioNoMayorEdad">
                    No, soy menor de edad
                </label>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-12">
        <label for="inputState" class="form-label">Cómo contactamos</label> <select name="contacto" id="inputState"
            class="form-select">
            <option selected>Elige...</option>
            <option value="telefono">Por teléfono</option>
            <option value="email">Por email</option>
        </select>
    </div>
    <div class="col-md-6 col-12">
        <label for="inputState" class="form-label">Qué gustos compartimos</label>
        <select id="inputState" class="form-select" multiple="true" name=hobbies[]>
            <option value="futbol">Fútbol</option>
            <option value="pintura">Pintura</option>
            <option value="cocinar">Cocinar</option>
        </select>
    </div>
    <div class="col-12">
        <input type="checkbox" name="lenguajes []" value="c" /> C<br />
        <input type="checkbox" name="lenguajes []" value="java" /> Java<br /> <input type="checkbox" name="lenguajes []"
            value="php" /> Php<br /> <input type="checkbox" name="lenguajes []" value="python" /> Python<br />
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
</form>
</html>