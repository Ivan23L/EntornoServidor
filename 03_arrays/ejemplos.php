<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EjemplosArrays</title>
    <link rel="stylesheet" type="text/css" href="./estilos.css">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<body>

    <?php
    /* 
    TODOS LOS ARRAYS EN PHP SON ASOCIATIVOS, COMO LOS MAP DE JAVA
    TIENEN PARES CLAVE-VALOR
    */

    $numeros = [5,10,9,6,7,4];
    $numeros = array(6,10,9,4,3);
    print_r($numeros);/* PRINT RELATIONAL sirve para imprimir por pantalla un array */
    echo"<br><br>";

    //animales = ["Perro","Gato","Ornitorrinco","Suricato","Dragonfly"];
    $animales = [
        "A01" => "Perro",
        "A02" => "Gato",
        "A03" => "Ornitorrinco",
        "A04" => "Suricato",
        "A05" => "Dragonfly",
    ];

    /* print_r($animales); */
    /* $animales = array(
        "Perro",
        "Gato",
        "Ornitorrinco",
        "Suricato",
        "Dragonfly",
    ); */


    /* El punto (.) para concatenar,
    Esto es una consulta para sacar un dato del array concreto */
    echo "<p>" . $animales["A05"] ."</p>";
    
    $animales[2] = "Koala";
    $animales[6] = "Iguana";
    /* print_r($animales); */
    $animales ["A01"] = "Elefante";
    /* print_r($animales); */
    array_push($animales, "Morsa", "Foca");
    $animales[] = "Ganso";

    unset($animales[1]); //Elimina del array 
    $animales = array_values($animales);
    echo "<p>" . $animales["4"] ."</p>";

    echo"<p><p><p>---------------</p></p></p>";

    //Como hemos reseteado las claves, aprovechamos para recorrer el array ahora
    echo"<h3>Lista de animales con FOR</h3>";
    echo"<ol>";
    for($i = 0;$i<count($animales);$i++){
        echo "<li>" . $animales[$i] . "</li>";
    }
    echo"</ol>";

    echo"<p><p><p>---------------</p></p></p>";

    echo"<h3>Lista de animales con WHILE</h3>";
    $i=0;
    echo"<ol>";
    while($i < count($animales)):
        echo"<li>$animales[$i]</li>";
        $i++;
    endwhile;
    echo"</ol>";

    echo"<p><p><p>---------------</p></p></p>";

    $cantidad_animales = count($animales);
    echo"<h3>Hay $cantidad_animales animales</h3>";

    print_r($animales);

    echo"<p><p><p>---------------</p></p></p>";

    /* 
        "4312 TDZ" => "Audi TT"
        "1122 FFF" => "Mercedes CLR"
        CREAR EL ARRAY CON 3 COCHES, AÑADIR 2 COCHES CON SUS MATRICULAS
        AÑADIR 1 COCHE SIN MATRICULA, BORRAR EL COCHE SIN MATRICULA 
        RESETEAR LAS CLAVES Y ALMACENAR EL RESULTADO EN OTRO ARRAY

    */

    $coches =[
        "4561 LLL" => "mercedes",
        "7841 OPL" => "carro",
        "7856 MJL" => "mitshu",
    ];
    /* print_r($coches); */

    $coches ["7987 POL"] = "bmw";
    $coches ["9874 JAS"] = "carrito";

    array_push($coches, "cochecito");

    unset($coches[0]);

    $coches2 = array_values($coches);
    
    //print_r($coches);
    //print_r($coches2);


    echo"<h3>Lista de coches con FOREACH</h3>";
    //$coche coge cada VALUE de cada elemento del array, también se puede coger la clave
    //$matricula
    echo"<ol>";
    foreach($coches as $matricula => $coche){
        echo"<li>$matricula, $coche</li>";
    }
    echo"</ol>";

    echo"ES DURO";
    echo"<p><p><p>---------------</p></p></p>";
    echo"<p><p><p>---------------</p></p></p>";


    //AÑADIR LAS MATRICULAS Y LOS COCHES RESPECTIVAMENTE EN LA SIGUIENTE TABLA
   ?>

    <table>
        <caption><h1>Coches</h1></caption>
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Coche</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            foreach($coches as $matricula => $coche){?>
            <!-- abro el bucle antes de lo que se va a ir repitiendo --> 
            <!-- Recomendable para BBDD -->
            
            <tr>
                <td><?php echo $matricula ?></td>
                <td><?php echo $coche ?></td>
            </tr>
            <?php } ?>

        </tbody>
    </table>
    
</body>
</html>