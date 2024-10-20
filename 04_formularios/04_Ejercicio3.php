<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
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

    <label for="numero1">Número 1:</label>
    <input type="text" name="numero1" id="numero1" placeholder="Introduce un numero">
    <br>
    <label for="numero2">Número 2:</label>
    <input type="text" name="numero2" id="numero2" placeholder="Introduce un numero">
    <br>
    <input type="submit" value="Enviar">
</form>
<?php

//Creo una función para buscar los primos (Ejercicio de clase)
function esPrimo($numero){
    //Sacamos el 0 y el 1 no los consideramos primos
    if($numero < 2){
        return false;
    }
    for ($i = 2; $i < $numero; $i++){
        if ($numero % $i == 0){
            //Si es divisible por cualquier número que no sea 1 y sí mismo, no es primo
            return false;
        }
    }
    //Devuelve el número primo pasados los filtros
    return true;
}



if($_SERVER["REQUEST_METHOD"] == "POST"){
$numero1 = $_POST["numero1"];
$numero2 = $_POST["numero2"];


// El número 1 tiene que ser menor que el segundo para que el rango tenga sentido
if ($numero1 > $numero2) {
    echo "<h3>El número 1 debe ser menor o igual que el número 2.</h3>";
} else {

    $numerosPrimos = [];
    for ($i = $numero1; $i < $numero2; $i++){
       if(esPrimo($i)){
        $numerosPrimos[] = $i;
       }
    }

    // Si el array de números primos entre el número1 y el número 2 no está vacío los muestra, sino, mostrará una frase
    if (!empty($numerosPrimos)) {
        echo "<h3>Los números primos entre $numero1 y $numero2 son:</h3>";
        echo "<ul>";
        foreach ($numerosPrimos as $numeroPrimo) {
            echo "<li>$numeroPrimo</li>";
        }
        echo "</ul>";
    } else {
        echo "<h3>No hay números primos entre $numero1 y $numero2.</h3>";
    }

}
}
?>
</body>
</html>