<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edades</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<body>
<form action="" method="post">
    <!-- 
    CREAR UN FORMULARIO QUE RECIBA EL NOMBRE Y LA EDAD DE UNA PERSONA
    SI LA EDAD ES MENOR QUE 18, SE MOSTRARÁ EL NOMBRE Y QUE ES MENOR DE EDAD
    SI LA EDAD ESTÁ ENTRE 18 Y 65, SE MOSTRARÁ EL NOMBRE Y QUE ES MAYOR DE EDAD
    SI LA EDAD ES MÁS DE 65, SE MOSTRARÁ EL NOMBRE Y QUE SE HA JUBILADO
    -->
<label for="nombre">Nombre</label>
<input type="text" name="nombre" id="nombre" placeholder="Introduce tu nombre amigo">

<br>

<label for="edad">Edad</label>
<input type="text" name="edad" id="edad" placeholder="Introduce tu edad">

<br>

<input type="submit" value="Enviar">
</form>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$nombre = $_POST["nombre"];
$edad = $_POST["edad"];
$estado = "";

/*
Si edad es menor que 18, la funcion match escribirá en estado "es menor de edad",
así con todas las situaciones
$estado = match(true){
    $edad < 18 => "es menor de edad",
    $edad > 65 => "se ha jubilado",
    $edad >= 18 and $edad <= 65 => "es mayor de edad"
}; 
*/

if($edad < 18){
    $estado = "es menor de edad";
}elseif($edad > 65){
    $estado = "se ha jubilado";
}else{
    $estado = "es mayor de edad";
}

echo"<h1>$nombre $estado</h1>";
}
?>
</body>
</html>