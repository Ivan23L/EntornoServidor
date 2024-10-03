<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicios</title>
    <?php
        error_reporting(E_ALL);
        ini_set( "display_errors", 1 );
    ?>
</head>
<body>



    <!-- 
    EJERCICIO 1: MOSTRAR LA FECHA ACTUAL CON EL SIGUIENTE FORMATO:
        Viernes 27 de Septiembre de 2024
    UTILIZAR LAS ESTRUCTURAS DE CONTROL NECESARIAS
    -->

    <?php
        $dia=date("l");
        $num=date("j");
        $mes=date("n");
        $año=date("Y");

        $dia = match ($dia) {
            "Monday" => "Lunes",    
            "Tuesday" => "Martes",
            "Wednesday" => "Miercoles",
            "Thursday" => "Jueves",
            "Friday" => "Viernes",
            "Saturday" => "Sabado",
            "Sunday" => "Domingo"
        };
        $mes = match($mes){
            "1" => "Enero",
            "2" => "Febrero",
            "3" => "Marzo",
            "4"=> "Abril",
            "5" => "Mayo",
            "6" => "Junio",
            "7" => "Julio",
            "8" => "Agosto",
            "9" => "Septiembre",
            "10" => "Octubre",
            "11" => "Noviembre",
            "12" => "Diciembre"
        };
        echo"<h3>$dia $num de $mes de $año </h3";
    ?>


    <!--EJERCICIO 2: MOSTRAR EN UNA LISTA LOS NÚMEROS MÚLTIPLOS DE 3 USANDO WHILE E IF-->
    <h3>EJERCICIO 2</h3>
    <?php
    echo"<h3>Los números múltiplos 3 en forma de lista: </h3";

        $i = 1;

        echo"<ul>";
        while($i <= 100):
            if($i % 3 == 0):
                echo"<li>$i</li>";
            endif;
            $i++;
        endwhile;
        echo"</ul>";
    ?> 

   <!--EJERCICIO 3: CALCULAR LA SUMA DE LOS NÚMEROS PARES ENTRE 1 Y 20 -->
    <h3>EJERCICIO 3</h3>
        <?php

        $i = 1;
        $suma = 0;
        while($i <= 20){
            if($i %2 == 0){
                $suma += $i;
            }
            $i++;
        }
        echo "<p> SOLUCION: LA SUMA DE LOS NÚMEROS PARES ENTRE 1 Y 20 ES $suma</p>"
    ?> 
    <!--EJERICIO 4: CALCULAR EL FACTORIAL DE 6 CON WHILE  -->
    <h3>EJERCICIO 4</h3>
    <?php

        $factorial = 6;
        $resultado = 1;
        $i = 1;
        while($i <= $factorial){
            $resultado *= $i;
            $i++;
        }
        echo "<p>SOLUCION: EL FACTORIAL DE $factorial ES $resultado </p>"
    ?> 
 <!--EJERICIO 5: MUESTRA POR PANTALLA LOS 50 PRIMEROS NÚMEROS PRIMOS-->
 <h3>EJERCICIO 5</h3>
    <?php
    /* BUCLE DE 2 A N - 1
    
    $n = 7
    DESDE 2 HASTA $n - 1
        COMPROBAR SI $n TIENE DIVISORES QUE DEN DE RESTO 0
            SI EXISTE ENTONCES DEVOLVER FALSO 
            ELSE DEVOLVER TRUE
    FIN
    */
        $numero = 2;
        $contadorPrimos = 0;
        
        echo "<ol>";
        while ($contadorPrimos < 50){
            $numeroPrimo = true;
            for ($i = 2; $i < $numero; $i++){
                if ($numero % $i == 0){
                    $numeroPrimo = false;
                    break;
                }
            }
            if($numeroPrimo){
                $contadorPrimos++;
                echo"<li>$numero</li>";
            }
            $numero++;
        }
        echo"</ol>";
       // var_dump($numeroPrimo);
    ?>

</body>
</html>