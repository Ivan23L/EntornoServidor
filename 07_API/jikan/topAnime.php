<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top anime</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
        $apiUrl = "https://api.jikan.moe/v4/top/anime";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $animes = $datos["data"];
        //print_r($animes);
    ?>
    <form action="" method="get">
        <label for="filtro">Filtrar por: </label>

        <p><input class='btn btn-primary' type="submit" value="Filtrar">
    </form>
    <table class = "table table-bordered table-light table-hover border-secondary text-center">
        <thead class=" table-danger">
            <tr>
                <th>Posición</th>
                <th>Título</th>
                <th>Productor</th>
                <th>Nota</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
        <!-- Añadir a los animes una lista con los productores de la serie.
        Los productores son las empresas encargadas en producir el anime.
        Una vez hecha la lista, mostraremos en un archivo productor.php el nombre
        por defecto del productor, su imagen y la información sobre el productor que nos provee la api (about) -->
        <?php
            foreach($animes as $anime) { ?>
                <tr>
                    <td class='table-success'><?php echo $anime["rank"] ?></td>
                    <td class='table-warning'>
                        <a href="anime.php?id=<?php echo $anime["mal_id"] ?>">
                            <?php echo $anime["title_japanese"] ?>
                        </a>
                    </td>
                    <td class='table-warning'>
                    <?php
                        // Verificar si hay productores
                        if (!empty($anime["producers"])) {
                            echo "<ul>";
                            //por cada anime se muestran en una lista sus productores
                            foreach ($anime["producers"] as $productor) {
                                echo "<li><a href='productor.php?id=" . $productor["mal_id"] . "'>" . $productor["name"] . "</a></li>";
                            }
                            echo "</ul>";
                        }
                    ?>
                    </td>
                    <td class='table-warning'><?php echo $anime["score"] ?></td>
                    <td class='table-info'>
                        <img width="100px" src="<?php echo $anime["images"]["jpg"]["image_url"] ?>">
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="container d-flex justify-content-center align-items-center">
        <a class="btn btn-primary" href="">Anterior</a>
        <a class="btn btn-primary" href="">Siguiente</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>