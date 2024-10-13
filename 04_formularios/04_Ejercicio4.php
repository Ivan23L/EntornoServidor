<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<h2>Introduce un número y a continuación selecciona su unidad y la unidad a la que quieres conventirla</h2>
<form action="" method="post">
    <!-- 
    Realiza un formulario que funcione a modo de conversor de temperaturas. Se introducirá en un campo de texto la temperatura, y luego tendremos un select para elegir las unidades de dicha temperatura, y otro select para elegir las unidades a las que queremos convertir la temperatura.

    Por ejemplo, podemos introducir "10", y seleccionar "CELSIUS", y luego "FAHRENHEIT". Se convertirán los 10 CELSIUS a su equivalente en FAHRENHEIT.

    En los select se podrá elegir entre: CELSIUS, KELVIN y FAHRENHEIT.
    -->

    <label for="numero">Número:</label>
    <input type="text" name="numero" id="numero" placeholder="Introduce un numero">
    
    <!-- Unidad Inicial del número que se introduce -->
    <label for="unidadInicial"></label>
    <select name="unidadInicial" id="unidadInicial">
        <option value="celsius">Celsius</option>
        <option value="kelvin">Kelvin</option>
        <option value="fahrenheit">Fahrenheit</option>
    </select>
    <br>
    <!-- Unidad a la que se va a conventir el número introducido -->
    <label for="unidadFinal">Convertir a: </label>
    <select name="unidadFinal" id="unidadFinal">
        <option value="celsius">Celsius</option>
        <option value="kelvin">Kelvin</option>
        <option value="fahrenheit">Fahrenheit</option>
    </select>
    <br>
    <input type="submit" value="Convertir">
</form>

<?php
//Función para convertir el número introducido de una unidad a otra
function convertirUnidad($numero, $inicial, $final){
    //Voy a convertir el número inicial siempre a celsius para hacer la conversión más cómoda

    switch($inicial){
        //El número introducido es la temperatura en celsius
        case 'celsius':
            $celsius = $numero;
            break;
        //conversión de kelvin a celsius
        case 'kelvin':
            $celsius =$numero - 273.15;
            break;
        //conversión de fahrenheit a celsius
        case 'fahrenheit':
            $celsius =($numero - 32) *5 / 9;
            break;
    }

    //Ahora lo convierto desde celsius a la unidad que me indique
    switch($final){
        //Es el número introducido
        case 'celsius':
            return $celsius;
        //conversión de celsius a kelvin
        case 'kelvin':
            return $celsius + 273.15;
        //conversión de celsius a fahrenheit
        case 'fahrenheit':
            return ($celsius * 9 / 5) + 32;
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $unidadInicial = $_POST["unidadInicial"];
    $unidadFinal = $_POST["unidadFinal"];
    $numero = $_POST["numero"];

    //LLamo a la función, primero el número introducido, segundo la unidad inicial y tercero la unidad final
    $conversion = convertirUnidad($numero, $unidadInicial, $unidadFinal);

    echo"<h3>Se han convertido $numero $unidadInicial a $conversion $unidadFinal</h3>";
}
?>
</body>
</html>