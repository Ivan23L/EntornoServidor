<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémons</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <form action="" method="get"></form>

    <?php

        //Indica el número de datos (pokémons) que nos devuelve la API y se muestran en cada página
        if (isset($_GET["limit"])) {
            $limite = $_GET["limit"];
            if ($limite < 1) {
                $limite = 5;
            }
        } else {
            $limite = 5;
        }

        //Indica el punto de partida en el que la API nos devolverá los datos
        if (isset($_GET["offset"])) {
            $offset = $_GET["offset"];
            if ($offset < 1) {
                $offset = 0;
            }
        } else {
            $offset = 0;
        }

        $pokemonApiUrl = "https://pokeapi.co/api/v2/pokemon/?offset=$offset&limit=$limite";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $pokemonApiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $pokemones = $datos["results"];
    ?>

        <br><br>
        <form method="get">
            <label for="limit">¿Cuantos pokémons quieres mostrar ?</label>
            <input type="number" id="limit" name="limit">
            <input class="btn btn-warning" type="submit" value="Mostrar">
        </form>
        <br><br>

        <table class="table table-bordered table-light table-hover border-secondary text-center">
            <thead class="table-dark">
                <tr>
                    <th>Pokémon</th>
                    <th>Imagen</th>
                    <th>Tipos</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                <?php foreach ($pokemones as $pokemon) { ?>
                <tr>
                    <?php
                    $nombrePokemon = $pokemon["name"];
                    $pokemonApiUrl = "https://pokeapi.co/api/v2/pokemon/$nombrePokemon";

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, $pokemonApiUrl);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $respuesta = curl_exec($curl);
                    curl_close($curl);


                    $datos = json_decode($respuesta, true);

                    ?>
                    <td class='table-warning'><?php echo ucfirst($datos["name"]); ?></td>
                    <td class='table-warning'><img src="<?php echo ($datos["sprites"]["front_default"]); ?>" alt="<?php echo ucfirst($datos["name"]); ?>" width="150"></td>                        
                    <td class='table-warning'>
                        <!-- Mostrar el tipo o ambos tipos separados por espacio -->
                        <?php foreach ($datos["types"] as $type) { ?>
                            <?php echo ucfirst($type["type"]["name"]) . " "; ?>
                        <?php } ?>
                    </td>
                <?php } ?>
                </tr>
            </tbody>
        </table>

        <?php 
        /* Si estamos en la primera página no mostrará el botón anterior */
            if ($offset <= 0) { ?>
                <a href="" hidden>Anterior</a> <?php 
            } else { ?>
                <a href="?offset=<?= ($offset - $limite) ?>&limit=<?= $limite ?>" class="btn btn-warning">Anterior</a> <?php 
            } ?>
        
        <!-- Para que mantenga el número que hay que mostrar tras pasar la página ó volver -->
        <a href="?offset=<?= ($offset + $limite) ?>&limit=<?= $limite ?>" class="btn btn-warning">Siguiente</a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>