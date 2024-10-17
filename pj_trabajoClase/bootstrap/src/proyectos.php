<?php
    $clase="proyectos";
    require 'includes/header.php';

    $proyectos=["Desarrollo app moviles","Migración bbdd", "tu prima la coja"]
?>
<h2>PROYECTOS</h2>
<div>
    <ul class="list-group">
        
        <?php
            foreach ($proyectos as $p) {
                echo "<li class='list-group-item active'>$p</li>";
            }
        ?>
    </ul>
</div>

</body>
</html>