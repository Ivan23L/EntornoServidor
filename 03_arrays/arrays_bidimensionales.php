<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays bidimensionales</title>
    <link href="estilos.css" rel = "stylesheet" type ="text/css">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
    ?>
</head>
<body>
    <?php

    $videojuegos = [
        /* "V01" = > ["TITULO" = > "Disco Elysium","CATEGORIA" = > "RPG",9.99], */
        ["Dragon Ball Z Kakarot","Acción",19.99],
        ["Persona 3","RPG",19.99],
        ["Comando 2","Estrategia",9.99],
        ["Dragon Ball Y Kaka","Acción",5.99],
        ["Dragon Ball XXX","Acción",9.99]
    ];

    //Aniadir nuevos elementos al array bidimensional
    $nuevo_videojuego = ["Octopath Traveler","RPG",29.55];
    //Cuando no se tocan las claves, lo mejor es usar array:push
    //HAY DOS MANERAS PRINCIPALMENTE:
    array_push($videojuegos, $nuevo_videojuego);
    array_push($videojuegos, ["Ender Lilies","Metroidvania",9.95]);

    array_push($videojuegos,["DOTA 2","MOBA",0]);
    array_push($videojuegos,["Lego Fortnite","Acción",0]);
    array_push($videojuegos,["Rocket League","Deporte",0]);
    array_push($videojuegos,["Fall guys","Plataforma",0]);

    for($i = 0; $i < count($videojuegos); $i++){
        $videojuegos[$i][3] ="GRATIS";
        if($videojuegos[$i][2] > 0){
            $videojuegos[$i][3] = "PAGA PAGA";
        }
    }

    /* unset($videojuegos[2]);
    $videojuegos = array_values($videojuegos); */

    //Si queremos volver a utilizar estas variables tendremos que sobreescribirlas de nuevo
    //Repetir la variable si quiero volver a usar un array_multisort
    $__titulo = array_column($videojuegos, 0);
    

    //Si fuera de manera ascendente, SORT_ASC
    $__titulo = array_column($videojuegos, 0);
    $__categoria = array_column($videojuegos,1);
    $__precio = array_column($videojuegos,2);
    array_multisort($__categoria, SORT_ASC, 
    $__precio,SORT_DESC,
    $__titulo, SORT_DESC,
    $videojuegos);


    ?>
<table>
    <thead>
        <tr>
            <th>Videojuego</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($videojuegos as $videojuego){

            //print_r($videojuego);  MUESTRA TODOS LOS ELEMENTOS

            //SOLO EXISTE DENTRO DEL FOREACH
            list($titulo,$categoria,$precio,$gratis) = $videojuego;
            echo"<tr>";
            echo"<td>$titulo</td>";
            echo"<td>$categoria</td>";
            echo"<td>$precio</td>";
            echo"<td>$gratis</td>";
            echo"</tr>";
        }
        ?>      
    </tbody>
</table>

</body>
</html>