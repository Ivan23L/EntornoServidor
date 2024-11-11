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
    <?php
    $array_vacio =[];
    $array1 = [];
    $array2 = [];

    //factorial de 0 es 1
    //Añado 5 valores aleatorios a ambos array1 y arra2(entre 1 y 10)
    for($i = 0;$i<5;$i++){
        $array1[$i] =rand(1,10);
    }
    //Añado 5 valores aleatorios a ambos array1 y arra2(entre 10 y 100)
    for($i = 0;$i<5;$i++){
        $array2[$i] =rand(10,100);
    }
    //añado los dos nuevos arrays al vacío
    array_push($array_vacio, $array1, $array2);

    /* 2.1 */
    echo "<h1>Muestro el array1 </h1><br>";
    for($i = 0;$i<count($array1);$i++){
        if($i == (count($array1) -1) ){
            echo $array1[$i] . ".";
        }else{
            echo   $array1[$i] . ", ";
        }
    }

    /* 2.2 */
    //El número aleatorio puede ser como mínimo el 0
    $numeroMayor1 = 0;
    //El número aleatorio puede ser como máximo el 10
    $numeroMenor1 =10;
    $media1 = 0;
    for($i = 0;$i<count($array1);$i++){
        if($array1[$i] > $numeroMayor1){
            $numeroMayor1 = $array1[$i];
        }
        if($array1[$i] < $numeroMenor1){
            $numeroMenor1 = $array1[$i];
        }
        $media1 += ($array1[$i]);
    }
    $media1 = $media1 / count($array1);
    echo "<br><h3>La media del array1 es: ".$media1."<br> El valor mayor en este array es: ".$numeroMayor1."<br>Mientras que el número menor es: ".$numeroMenor1."</h3><br>";


    echo "<h1>Muestro el array2 </h1><br>";
    for($i = 0;$i<count($array2);$i++){
        if($i == (count($array2) -1) ){
            echo $array2[$i] . ".";
        }else{
            echo   $array2[$i] . ", ";
        }
    }

    
    //El número aleatorio puede ser como mínimo el 10
    $numeroMayor2 = 10;
    //Lo pongo en 100 ya que el número será como máximo el 100
    $numeroMenor2 =100;
    $media2 = 0;
    for($i = 0;$i<count($array2);$i++){
        if($array2[$i] >= $numeroMayor2){
            $numeroMayor2 = $array2[$i];
        }
        if($array2[$i] <= $numeroMenor2){
            $numeroMenor2 = $array2[$i];
        }
        $media2 += ($array2[$i]);
    }
    $media2 = $media2/count($array2);
    echo "<br><h3>La media del array2 es: ".$media2."<br> El valor mayor en este array es: ".$numeroMayor2."<br>Mientras que el número menor es: ".$numeroMenor2."</h3><br>";
    ?>
</body>
</html>