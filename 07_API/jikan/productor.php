<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    
    ?>
</head>
<body>
    <?php
    //no se puede entrar en anime.php directamente
        if(!isset($_GET["id"])){
            header("location: topAnime.php");
        }
        $id = $_GET["id"];
        $apiUrl = "https://api.jikan.moe/v4/producers/$id/full";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $producers = $datos["data"];
    ?>
    <h1>Nombre del productor</h1>
    <h1><?php echo $producers["titles"]["0"]["title"]?></h1>

    <h1>Logo productor</h1>
    <img width="200px" src="<?php echo $producers["images"]["jpg"]["image_url"] ?>">

    <h3>Información About Producers</h3>
    <p> <?php echo $producers["about"] ?></p>
</body>
</html>