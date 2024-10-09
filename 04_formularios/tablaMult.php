<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablas de multiplicar</title>
</head>
<body>
    <!-- 
    CREAR UN FORMULARIO QUE RECIBA UN NÚMERO 
    SE MOSTRARÁ LA TABLA DE MULTIPLICAR DE ESE NÚMERO EN UNA TABLA HTML
    -->
<form action="" method="post">
<label for="numero">Numero</label>
<input type="text" name="numero" id="numero" placeholder="Introduce un numero amigo">
<link href="estilos.css" rel = "stylesheet" type ="text/css">
</form>

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
</form>

</body>
</html>