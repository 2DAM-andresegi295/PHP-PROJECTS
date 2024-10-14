<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de 1 a 100</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <table>
        <?php
        $numero = 1;
        for ($fila = 0; $fila < 10; $fila++) {
            echo "<tr>";
            for ($columna = 0; $columna < 10; $columna++) {
                echo "<td>$numero</td>";
                $numero++;
            }
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
