<?php
require './includes/data.php';
require './includes/header.php';

?>

<div class="container my-5">
    <div class="row">
        <!-- Columna de tareas to_do -->
        <div class="col-md-4">
            <h2 class="text-center bg-danger text-dark p-2 rounded">TO DO</h2>
            <div class="card-columns">
               
            </div>
        </div>

        <!-- Columna de tareas doing -->
          <div class="col-md-4">
            <h2 class="text-center bg-warning text-dark p-2 rounded">DOING</h2>
            <div class="card-columns">
              
            </div>
        </div>

        <!-- Columna de tareas done -->
        <div class="col-md-4">
            <h2 class="text-center bg-success text-white p-2 rounded">DONE</h2>
            <div class="card-columns">
               
            </div>
        </div>
    </div>
</div>