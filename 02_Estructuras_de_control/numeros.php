<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Números</title>
</head>
<body>

    <?php
    // Comparar números

    $numero = 16134;

    // Forma 1
    if($numero > 0) {
        echo "<p>El número $numero es mayor que cero</p>";
    } elseif ($numero == 0) {
        echo "<p>El número $numero es cero</p>";
    } else {
        echo "<p>El número $numero es menor que cero</p>";
    }

    // Forma 2
    if ($numero > 0) echo "<p>El número $numero es mayor que cero</p>";
    elseif ($numero == 0) echo "<p>El número $numero es cero</p>";
    else echo "<p>El número $numero es menor que cero</p>";

    // Forma 3
    if($numero > 0):
        echo "<p>El número $numero es mayor que cero</p>";
    elseif ($numero == 0):
        echo "<p>El número $numero es cero</p>";
    else:
        echo "<p>El número $numero es menor que cero</p>";
    endif;

    ?>

    <?php
    // Rangos [-10,0),[0,10],(10,20]

    $num = -2;

    // && o and para conjunción

    // FORMA 1
    if ($num >= -10 and $num < 0) {
        echo "<p>EL número $num está en el rango [-10,0)</p>";
    } elseif ($num >= 0 && $num <= 10) {
        echo "<p>EL número $num está en el rango [0,10]</p>";
    } elseif ($num > 10 && $num <= 20) {
        echo "<p>EL número $num está en el rango (10,20]</p>";
    } else {
        echo "<p>EL número $num está fuera del rango</p>";
    }

    // FORMA 2
    if ($num >= -10 and $num < 0) echo "<p>EL número $num está en el rango [-10,0)</p>";
    elseif ($num >= 0 && $num <= 10) echo "<p>EL número $num está en el rango [0,10]</p>";
    elseif ($num > 10 && $num <= 20) echo "<p>EL número $num está en el rango (10,20]</p>";
    else echo "<p>EL número $num está fuera del rango</p>";


    // FORMA 3
    if ($num >= -10 and $num < 0):
        echo "<p>EL número $num está en el rango [-10,0)</p>";
    elseif ($num >= 0 && $num <= 10):
        echo "<p>EL número $num está en el rango [0,10]</p>";
    elseif ($num > 10 && $num <= 20):
        echo "<p>EL número $num está en el rango (10,20]</p>";
    else:
        echo "<p>EL número $num está fuera del rango</p>";
    endif;

    ?>

    <?php 
    
    $num_alea = rand(1,200); # [1,200]
    $num_alea_decimal = rand(10,100)/10; // Numero aleatorio con decimales

    /* COMPROBAR DE TRES FORMAS DIFERENTES, CON LA ESTRUCTURA IF, SI EL NÚMERO ALEATORIO TIENE 1, 2 O 3 DÍGITOS */

    $digitos = null;

    // FORMA 1
    if ($num_alea > 0 && $num_alea < 10) {
        $digitos = 1;
    } elseif ($num_alea >= 10 and $num_alea < 100) {
        $digitos = 2;
    } else {
        $digitos = 3;
    }

    // FORMA 2
    if ($num_alea > 0 && $num_alea < 10) $digitos = 1;
    elseif ($num_alea >= 10 and $num_alea < 100) $digitos = 2;
    else $digitos = 3;

    // FORMA 3
    if ($num_alea > 0 && $num_alea < 10):
        $digitos = 1; 
    elseif ($num_alea >= 10 and $num_alea < 100):
        $digitos = 2;
    else:
        $digitos = 3;
    endif;

    $digitos_texto = "dígitos.";
    if ($digitos == 1) $digitos_texto = "dígito.";
    echo "<p>El número $num_alea tiene $digitos $digitos_texto</p>";
    
    //VERSION CON MATCH
    $digitos = match (true) {
        $num_alea >= 1 && $num_alea <= 9 => 1 ,
        $num_alea >= 10 && $num_alea <= 99 => 2 ,
        $num_alea >= 100 && $num_alea <= 999 => 3,
        default => "ERROR"
    };

    echo"<h1> El número tiene $digitos dígitos </h1>";

    ?>

    <?php

    $n = rand(1,3);

    switch($n) {
        case 1:
            echo "El número es 1";
            break;
        case 2:
            echo "El número es 2";
            break;
        default:
            echo "El número es 3";
    }

    $resultado = match($n){
        1 => "El numero es 1",
        2 => "El número es 2",
        3 => "El número es 3"
    };
    echo"<h3>$resultado</h3>";

    ?>



</body>
</html>