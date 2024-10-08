<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas</title>
    <link href="estilos.css" rel = "stylesheet" type ="text/css">
</head>
<body>
    <?php
    $peliculas = [
        ["Kárate a muerte en Torremolinos","Acción",1975],
        ["Sharknado 1-5","Acción",2015],
        ["Princesa por sorpresa 2","Comedia",2008],
        ["Cariño, he encogido a los niños","Aventuras",2001],
        ["Toy Story","Infantil",2000]
    ];

    /*
        1.AÑADIR CON UN RAND, LA DURACION DE CADA PELICULA. LA DURACION SERÁ UN NÚMERO 
        ALEATORIO ENTRE 30 Y 240

        2.AÑADIR COMO UNA NUEVA COLUMNA, EL TIPO DE PELICULA. EL TIPO SERÁ:
        -   CORTOMETRAJE, SI LA DURACIÓN ES MENOR QUE 60
        -   LARGOMETRAJE, SI LA DURACIÓN ES MAYOR O IGUAL QUE 60  

        3.MOSTRAR EN OTRA TABLA, TODAS LAS COLUMNAS, Y ORDENAR ADEMÁS EN ESTE ORDEN:
            1.GÉNERO
            2.AÑO
            3.TITULO (TODO ALFABÉTICAMENTE, Y EL AÑO DE MÁS RECIENTE A MÁS ANTIGUO)
    */

    /* 1 */
    for($i=0;$i < count($peliculas);$i++){
        $peliculas[$i][3]=rand(30,240);

        if($peliculas[$i][3]<60)$peliculas[$i][4]="CORTOMETRAJE";
        else $peliculas[$i][4]="LARGOMETRAJE";
    }


    $titulo = array_column($peliculas,0);
    $categoria = array_column($peliculas,1);
    $anio = array_column($peliculas,2);


    array_multisort($categoria, SORT_ASC,$anio,SORT_DESC,$titulo,SORT_ASC,$peliculas);

    ?>
<table>
    <thead>
        <tr>
            <th>Título</th>
            <th>Categoría</th>
            <th>Año de Salida</th>
            <th>Duración</th>
            <th>Tipo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach($peliculas as $pelicula){

            //print_r($videojuego);  MUESTRA TODOS LOS ELEMENTOS

            //SOLO EXISTE DENTRO DEL FOREACH
            list($titulo,$categoria,$anio,$duracion,$tipo) = $pelicula;
            echo"<tr>";
            echo"<td>$titulo</td>";
            echo"<td>$categoria</td>";
            echo"<td>$anio</td>";
            echo"<td>$duracion</td>";
            echo"<td>$tipo</td>";
            echo"</tr>";
        }
        ?>      
    </tbody>
</table>
</body>
</html>