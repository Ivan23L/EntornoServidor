<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex completa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        $id = $_GET["id"];
        $apiUrl = "https://pokeapi.co/api/v2/pokemon/$id/";
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
    ?>
    <div>
        <h1><?php echo ucwords($datos["name"])?></h1>
        <div id="details">
            
            <img width="200px" src="<?php echo $datos["sprites"]["front_default"]?>" class="img-fluid">
            <br>
            <p><b>Altura:</b> <?php echo $datos["height"]?>feet</p>
            <p><b>Peso:</b> <?php echo $datos["weight"]?>lbs</p>
            <p> 
            <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo/s</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // Recorrer y mostrar los tipos en una tabla
                foreach ($datos["types"] as $tipo) {
                    echo "<tr><td>" . ucwords($tipo["type"]["name"]) . "</td></tr>";
                }
            ?>
        </tbody>
    </table>
            </p>
            <p><b>Stats:</b>
            <ul>
                <?php 
                    // Recorrer y mostrar los stats
                    foreach ($datos["stats"] as $stat) {
                        echo "<li>" . ucwords($stat["stat"]["name"]) . ": " . $stat["base_stat"] . "</li>";
                    }
                ?>
            </ul>
            </p>
        </div><br>
        <a href="./index.php" class="btn btn-primary">Volver</a>
    </div>
</body>
</html>