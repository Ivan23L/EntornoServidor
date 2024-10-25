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
<h2>Introduce un número y selecciona una opción</h2>
<form action="" method="post">

    <label for="numero">Número:</label>
    <input type="text" name="numero" id="numero" placeholder="Introduce un numero">
    <br>
    <label for="convertir"></label>
    <select name="convertir" id="convertir">
        <option value="sumatorio">Sumatorio</option>
        <option value="factorial">Factorial</option>
    </select>
    <br>
    <input type="submit" value="Enviar">
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$numero = $_POST["numero"];
$convertir = $_POST["convertir"];
$sumatorio = 0;
$factorial = 1;

switch($convertir){
    case 'factorial':
        for($i=1;$i<$numero+1;$i++){
            $factorial *= $i;
        }
        echo"<h3>El factorial de $numero es $factorial</h3>";
        break;
    case 'sumatorio':
        for($i=0;$i<$numero;$i++){
            $sumatorio += $numero;
        }
        echo"<h3>El sumatorio de $numero es $sumatorio</h3>";
        break;
}
}
?>
</body>
</html>