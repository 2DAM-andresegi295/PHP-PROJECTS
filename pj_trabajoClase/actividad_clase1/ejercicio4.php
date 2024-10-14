<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retención</title>
</head>
<body>
<form method="POST" action="">
        <p>
            <label for="salario">Salario:</label>
            <input type="text" name="salario">
        </p>

        <p>
            <lable for="retencion">Retención:</lable>
            <input type="text" name="retencion">
        </p>
        <p>
            <input type="submit" value="Enviar">
        </p>
    </form>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $salario=$_POST['salario'];
        $retencion=$_POST['retencion'];
        echo 'Su salario neto es: '.$salario-($salario*($retencion/100));
        }
    ?>
</body>
</html>