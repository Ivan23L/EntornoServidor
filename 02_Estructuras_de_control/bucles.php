<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bucles</title>
</head>
<body>

<!-- Empezamos por el while amigo -->
    <h1>Lista con WHILE</h1>
    <?php

        $i = 1;

        echo"<ul>";
        while($i <= 10){
            echo"<li>$i</li>";
            $i++;
        }
        echo"</ul>";
    ?>
<!-- Otra forma de sintaxis para el WHILE -->
    <h1>Lista con WHILE alternativa</h1>
    <?php

        $i = 1;

        echo"<ul>";
        while($i <= 10):
            echo"<li>$i</li>";
            $i++;
        endwhile;
        echo"</ul>";
    ?>

    
    <!-- Empezamos con los bucles FOR -->
    <h1>Lista con FOR</h1>
    <?php
        echo "<ul>";
        for($i=1;$i<=10;$i++){
            echo"<li>$i</li>";
        }
        echo"</ul>";
    ?>
    <h1>Lista con FOR ALTERNATIVA</h1>
    <?php
        echo "<ul>";
        for($i=1;$i<=10;$i++):
            echo"<li>$i</li>";
        endfor;
        echo"</ul>";
    ?>
    <!-- Empezamos con los bucles FOR -->
    <h1>Lista con FOR con BREAK cursed</h1>
    <?php
        echo "<ul>";
        /* Cualquiera de las tres unidades del FOR es OPCIONAL */
        /* Codigo ofuscado */
        $i = 1;
        for ( ; ; ){
            if($i >10){
                break;
            }
            echo"<li>$i</li>";
        }
        echo"</ul>";
    ?>


</body>
</html>