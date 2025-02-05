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
        if (isset($_GET["page"])) {
            $paginaPrincipal = $_GET["page"];
            if ($paginaPrincipal < 1) {
                $paginaPrincipal = 1;
            }
        } else {
            $paginaPrincipal = 1;
        }

        if (isset($_GET["type"])) {
            $filtro = $_GET["type"];
        } else {
            $filtro = "";
        }

        //SIEMPRE QUE FALLE MIRA LA APIURL
        $apiUrl = "https://api.jikan.moe/v4/top/anime?page=$paginaPrincipal&type=$filtro";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $animes = $datos["data"];
        $paginas = $datos["pagination"];
        //print_r($animes);

        $paginaActual = $paginas["current_page"];
        $nextPagina = ($paginaActual + 1);
        $prePagina = ($paginaActual - 1);
        $totalPaginas = $paginas["last_visible_page"];
    ?>
    <form action="" method="get">
        <br><h5>Filtrar por:</h5>
        <input type="radio" id="tv" name="type"
            <?php if ($filtro == "tv") {
                echo "checked"; 
            } ?>>
        <label for="tv">Serie </label>
        <input type="radio" id="movie" name="type"
            <?php if ($filtro == "movie") {
                echo "checked"; 
            } ?>>
        <label for="movie">Película </label>
        <input type="radio" id="todo" name="type"
            <?php if ($filtro == "") { 
                echo "checked"; 
            } ?>>
        <label for="todo">Todo </label><br>
        <input class="btn btn-warning" type="submit" value="Filtrar"><br><br>
    </form>

    <br><br>

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
    <div class="d-flex justify-content-center my-3">
        <!-- Página anterior -->
        <?php
            if ($paginaActual > 1 && $filtro != "") { ?>
                <a class="btn btn-primary" href="?page=<?php echo $prePagina ?>&type=<?php echo $filtro ?>">Anterior</a>
        <?php } else if ($paginaActual > 1) { ?>
                <a class="btn btn-primary" href="?page=<?php echo $prePagina ?>">Anterior</a>
        <?php } else { ?>
                <a href="#" hidden>Anterior</a>
        <?php } ?>

            <!-- Siguiente página -->
        <?php
            if ($paginaActual < $totalPaginas && $filtro != "") { ?>
                <a class="btn btn-primary" href="?page=<?php echo $nextPagina ?>&type=<?php echo $filtro ?>">Siguiente</a>
        <?php } else if ($paginaActual < $totalPaginas) { ?>
                <a class="btn btn-primary" href="?page=<?php echo $nextPagina ?>">Siguiente</a>
        <?php } else { ?>
                <a href="#" hidden>Siguiente</a>
        <?php } ?>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>