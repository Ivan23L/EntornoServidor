<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3, ALEJANDRA</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<body>
<h2>Introduce dos números, se mostrarán todos los números primos dentro de ese rango</h2>
<form action="" method="post">
    <!-- 
    Realiza un formulario que reciba dos números y devuelva todos los números primos dentro de ese rango (incluidos los extremos).
    -->

    <label for="numero1">Desde:</label>
    <input type="desde" name="desde" id="desde" placeholder="Introduce un numero">
    <br>
    <label for="hasta">Hasta:</label>
    <input type="text" name="hasta" id="hasta" placeholder="Introduce un numero">
    <br>
    <input type="submit" value="Enviar">
</form>
<?php


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $desde = $_POST["desde"];
    $hasta = $_POST["hasta"];


    // El número 1 tiene que ser menor que el segundo para que el rango tenga sentido
    
    echo "<ul>";
    for ($i = $desde; $i <= $hasta; $i++){
        $esPrimo = true;
        for($j = 2; $j < $i; $j++){
            if($i % $j == 0){
                $esPrimo = false;
                break;
            }
        }
        if($esPrimo){
            echo"<li>$i</li>";
        }
    }
    echo"</ul>";

    
}
?>
</body>
</html>