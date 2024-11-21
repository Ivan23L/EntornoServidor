<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);
        require ('conexion.php');
    ?>
</head>
<body>
    <div class="container mt-5">
        <h1>Tabla de animes</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //por convención se usa siempre el id para borrar, pero se podría usar el titulo
                $idAnime = $_POST["id_anime"];
                //borrar el anime
                $sql = "DELETE FROM animes WHERE id_anime = $idAnime";
                $_conexion -> query($sql);
            }

            $sql = "SELECT * FROM animes";
            $resultado = $_conexion -> query($sql);
            
            /*
            INSERT INTO estudios VALUES ('Studio Bind', 'Tokio', 2018);
            INSERT INTO estudios VALUES ('Production I.G', 'Tokio', 1987);
            INSERT INTO estudios VALUES ('White Fox', 'Tokio', 2007);
            INSERT INTO estudios VALUES ('Gainax', 'Tokio', 1984);
            INSERT INTO estudios VALUES ('ufotable', 'Tokio', 2000);
            INSERT INTO estudios VALUES ('CoMix Wave Films', 'Tokio', 2007);

            INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas) 
                VALUES ('Mushoku Tensei', 'Studio Bind', 2021, 2);
            INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas) 
                VALUES ('Kuroko No Basket', 'Production I.G', 2012, 3);
            INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas) 
                VALUES ('Re:Zero - Starting Life in Another World', 'White Fox', 2016, 4);
            INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas) 
                VALUES ('Neon Genesis Evangelion', 'Gainax', 1995, 1);
            INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas) 
                VALUES ('Demon Slayer', 'ufotable', 2019, 3);
            INSERT INTO animes (titulo, nombre_estudio, anno_estreno, num_temporadas) 
                VALUES ('Your Name', 'CoMix Wave Films', 2016, 1);
                
            Aplicamos la función query(es una consulta) a la conexión(es un objeto), donde se ejecuta la sentencia SQL hecha
            El resultado se almacena en $resultado, que es un objeto con una estructura parecida a los arrays
            */
            //En esta linea se indica que sobre el objeto $_conexion se ejecuta la función query() y se guarda en la variable $resultado
        ?>
        <a href="../formularios/nuevoAnime.php" class="btn btn-secondary">Crear nuevo anime</a>
        <table class = "table table-bordered table-light table-hover border-secondary text-center">
            <thead class=" table-danger">
                <tr>
                    <th>Título</th>
                    <th>Estudio</th>
                    <th>Año</th>
                    <th>Número de temporadas</th>
                    <th>Imagen</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    //Trata el objeto resultado como si fuera un array asociativo, y mientras haya filas, 
                    //fetch_assoc() los guardará ahora sí en un array 
                    while($fila = $resultado -> fetch_assoc()){
                        //Cada valor que devuleve tiene dos claves, tanto el nombre de la columna, como el valor que le corresponde a la columna
                        echo"<tr>";
                        echo "<td class='table-warning'>" . $fila["titulo"] . "</td>";
                        echo "<td class='table-success'>" . $fila["nombre_estudio"] . "</td>";
                        echo "<td class='table-success'>" . $fila["anno_estreno"] . "</td>";
                        echo "<td class='table-info'>" . $fila["num_temporadas"] . "</td>";
                        ?>
                        <td class='table-info'>
                            <img width="100" height="150" src="<?php echo $fila["imagen"]?>">
                        </td>
                        <td class='table-secondary'>
                            <a class="btn btn-primary" 
                            href="editarAnimes.php?id_anime=<?php echo $fila["id_anime"]?>">Editar</a>
                        </td>
                        <td class='table-light'>
                            <form action="" method="post">
                                <!-- Hago que sea dinámico, cada anime tiene un ID único -->
                                <input type="hidden" name="id_anime" value="<?php echo $fila["id_anime"]?>">
                                <input type="submit" value="Borrar" class="btn btn-danger">
                            </form>
                        </td>
                        <?php
                        echo"</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>