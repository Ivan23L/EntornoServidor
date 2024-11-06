<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<body>
<h2>Introduce tres números, se mostrará el mayor de los tres</h2>
<form action="" method="post">
    <!-- 
    Realiza un formulario que reciba 3 números y devuelva el mayor de ellos.
    -->

    <label for="numero1">Número 1:</label>
    <input type="text" name="numero1" id="numero1" placeholder="Introduce el primer numero">
    <br>
    <label for="numero2">Número 2:</label>
    <input type="text" name="numero2" id="numero2" placeholder="Introduce el segundo numero">
    <br>
    <label for="numero3">Número 3:</label>
    <input type="text" name="numero3" id="numero3" placeholder="Introduce el tercer numero">
    <br>
    <input type="submit" value="Enviar">
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$numero1 = $_POST["numero1"];
$numero2 = $_POST["numero2"];
$numero3 = $_POST["numero3"];

//La función max calcula el mayor 
$numeroMayor = max($numero1, $numero2, $numero3);

echo"<h3>El mayor de los tres números es: $numeroMayor</h3>";

}
?>
</body>
</html>