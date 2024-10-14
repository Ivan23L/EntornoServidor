<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salario</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<h2>Introduce tu salario bruto y se mostrará tu salario neto</h2>
<form action="" method="post">
    <!-- 
    Introducir el salario bruto y calcular el salario neto
    -->
    <label for="salarioBruto">Salario Bruto:</label>
    <input type="text" name="salarioBruto" id="salarioBruto" placeholder="Introduce tu salario bruto">
    
    <input type="submit" value="Enviar">
</form>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $bruto = $_POST["salarioBruto"];
    
    $salarioNeto;
    
    if ($bruto < 12450){
        $impuesto = $bruto - ($bruto * 1.19);
    }elseif($bruto > 12450 && $bruto < 20199){
        $impuesto = $bruto * 1.24;
    }elseif($bruto > 20199 && $bruto < 35199){
        $impuesto = $bruto * 1.30;
    }elseif($bruto > 35199 && $bruto < 59999){
        $impuesto = $bruto * 1.37;
    }elseif($bruto > 59999 && $bruto < 299999){
        $impuesto = $bruto * 1.45;
    }elseif($bruto >= 300000){
        $impuesto = $bruto * 1.47;
    }

    echo"<h3>Tu salario bruto $bruto se queda en un salario neto de $neto</h3>";
}
?>
</body>
</html>