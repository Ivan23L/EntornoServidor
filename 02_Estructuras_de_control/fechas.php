<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas</title>

    <!-- Para mostrar Errores -->
    <?php
        error_reporting(E_ALL);
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>

    

    <?php
    /* 
    "2" == 2 - Dos iguales compara el numero.
    "2" === 2 - Tres iguales compara el numero y el tipo.
    "2" !== 2 - 
    */

    $numero = "2";

    if($numero == 2){
        echo "ES EL MISMO NUMERO.<br>";
    }

    if($numero !== 2){
        echo "ES EL MISMO NUMERO PERO NO EL MISMO TIPO";
    }

    ?>

    <?php

    $hora = (int) date("G");
    # var_dump($hora);

    /* 
        SI $hora ENTRE 6 y 11, es MAÑANA
        SI $hora ENTRE 12 y 14, es MEDIODÍA
        SI $hora ENTRE 15 y 20, es TARDE
        SI $hora ENTRE 21 y 24, es NOCHE
        SI $hora ENTRE 1 y 5, es MADRUGRADA
    */
    $text_hora = null;
    if($hora >= 6 && $hora <= 11){
        $text_hora = "mañana";
    }elseif($hora >= 12 && $hora <= 14){
        $text_hora = "mediodía";
    }elseif($hora >= 15 && $hora <= 20){
        $text_hora = "tarde";
    }elseif($hora >= 21 && $hora <= 24){
        $text_hora = "noche";
    }elseif($hora >= 1 && $hora <= 5){
        $text_hora = "madrugada";
    }else{
        $text_hora = "ERROR";
    }

    echo "<p>Son las $hora de la $text_hora.</p>";


    $dia = date("l");
    echo "<h2>Hoy es $dia</h2>";


    /* 
        TENEMOS CLASE LUNES, MIERCOLES Y VIERNES NO TENEMOS CLASE EL RESTO.
        HACER UN SWITCH QUE DIGA SI HOY TENEMOS CLASE O NO.
    */


    switch ($dia){
        case "Monday":
        case "Wednesday":
        case "Friday":
            echo "Hoy $dia tenemos clase";
            break;
        default:
            echo "Hoy $dia no tenemos clase";
            break;
    }

    /* 
        REESCRIBIR EL SWITCH DE LOS DIAS DE CLASE CON LA VARIABLE EN ESPAÑOL
    */

    $dia=date("l");
    $dia_espanol = null;

    $dia_espanol = match ($dia) {
        "Monday" => "Lunes",    
        "Tuesday" => "Martes",
        "Wednesday" => "Miercoles",
        "Thursday" => "Jueves",
        "Friday" => "Viernes",
        "Saturday" => "Sabado",
        "Sunday" => "Domingo"
    };
    echo"<h3>$dia_espanol</h3";
    
    ?>





</body>
</html>