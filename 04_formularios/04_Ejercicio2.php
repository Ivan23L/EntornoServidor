<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<body>
<h2>Introduce tres números, se mostrarán en una lista los múltiplos de C que se encuentren entre a y b</h2>
<form action="" method="post">
    <!-- 
    Realiza un formulario que reciba 3 números: a, b y c. Se mostrarán en una lista los múltiplos de c que se encuentren entre a y b.

    Por ejemplo, si a = 3, b = 10, c = 2

    Los múltiplos de 2 entre 3 y 10 son: 4, 6, 8 y 10
    -->

    <label for="numeroA">Número a:</label>
    <input type="text" name="numeroA" id="numeroA" placeholder="Introduce un numero">
    <br>
    <label for="numeroB">Número b:</label>
    <input type="text" name="numeroB" id="numeroB" placeholder="Introduce un numero">
    <br>
    <label for="numeroC">Número c:</label>
    <input type="text" name="numeroC" id="numeroC" placeholder="Introduce un numero">
    <br>
    <input type="submit" value="Enviar">
</form>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$numeroA = $_POST["numeroA"];
$numeroB = $_POST["numeroB"];
$numeroC = $_POST["numeroC"];

// A tiene que ser menor que B para que el rango tenga sentido
if ($numeroA > $numeroB) {
    echo "<h3>El número A debe ser menor o igual que el número B.</h3>";
} else {
    $multiplosC = [];
// Si el rango es válido ahora lo recorre para encontrar los múltiplos de C
    for ($i = $numeroA; $i <= $numeroB; $i++) {
        if ($i % $numeroC == 0) {
            $multiplosC[] = $i;
        }
    }

// Si el array de múltiplos entre A y B no está vacío los muestra, sino, mostrará una frase
    if (!empty($multiplosC)) {
        echo "<h3>Los múltiplos de $numeroC entre $numeroA y $numeroB son:</h3>";
        echo "<ul>";
        foreach ($multiplosC as $multiploC) {
            echo "<li>$multiploC</li>";
        }
        echo "</ul>";
    } else {
        echo "<h3>No hay múltiplos de $numeroC entre $numeroA y $numeroB.</h3>";
    }
}
}
?>
</body>
</html>