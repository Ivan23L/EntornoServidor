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
    <?php
    //Creo el array y lo relleno con 4 animes de la tabla del ejercicio 3
    $animes_japoneses =[
        ["Dandadan","Acción"],
        ["Tragones y mazmorras","Comedia"],
        ["Los diarios de la boticaria","Histórico"],
        ["Frieren","Fantasía"]
    ];
    //Añado dos nuevos animes al array
    array_push($animes_japoneses,["One Piece","Aventura"]);
    array_push($animes_japoneses, ["Shin Chan","Comedia"]);

    //Elimino el primer anime del array
    unset($animes_japoneses[0]);
    $animes_japoneses = array_values($animes_japoneses);

    //El año de salida se genera de forma aleatorio entre 1990/2030 en la tercera columna
    for($i=0;$i < count($animes_japoneses);$i++){
        $animes_japoneses[$i][2]=rand(1990,2030);
    }

    //Añado la cuarta columna con un numero de espisodios aleatorios entre 1 y 99
    for($i=0;$i < count($animes_japoneses);$i++){
        $animes_japoneses[$i][3]=rand(1,99);
    }

    //Añado la quinta columna si es anterior o igual a 2024 se muestra YA DISPONIBLE sino PROXIMAMENTE
    for($i = 0; $i < count($animes_japoneses); $i++){
        $animes_japoneses[$i][4] ="Próximamente";
        if($animes_japoneses[$i][2] <= 2024){
            $animes_japoneses[$i][4] = "Ya disponible";
        }
    }
    
    
    $__titulo = array_column($animes_japoneses, 0);
    $__genero = array_column($animes_japoneses, 1);
    $__anio = array_column($animes_japoneses, 2);
    $__episodios = array_column($animes_japoneses, 3);
    $__disponible = array_column($animes_japoneses, 4);

    array_multisort($__genero, 
    $__anio,
    $__titulo,
    $animes_japoneses);

    
    ?>
    <!-- Le he puesto un borde a la tabla para que se vea mejor -->
    <table border = 1px solid>
    <thead>
        <tr>
            <th>Título</th>
            <th>Género</th>
            <th>Año de Salida</th>
            <th>Episodios</th>
            <th>Disponibilidad</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($animes_japoneses as $anime_japones){

            //SOLO EXISTE DENTRO DEL FOREACH
            list($__titulo,$__genero,$__anio,$__episodios,$__disponible) = $anime_japones;
            echo"<tr>";
            echo"<td>$__titulo</td>";
            echo"<td>$__genero</td>";
            echo"<td>$__anio</td>";
            echo"<td>$__episodios</td>";
            echo"<td>$__disponible</td>";
            echo"</tr>";
        }
        ?>      
    </tbody>
    </table>
</body>
</html>