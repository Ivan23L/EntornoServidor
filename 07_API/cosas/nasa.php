<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NASA</title>
</head>

<body>

    <?php
    $apiUrl = "https://api.nasa.gov/planetary/apod";
    $apiKey = "vhBaWeP83TivVZcH5KS5pwmpt6iLbrMaTu2zly3b";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, $apiKey . ":");
    $respuesta = curl_exec($curl);
    $array = json_decode($respuesta, true);

    print_r($array);
    ?>
    <h1>Astronomy Picture of the Day</h1>
    <img src="<?php echo $array['url'] ?>" alt="">
    <h5>
        <?php echo $array['title'] ?>
    </h5>
    <h5>Image Credit & Copyright:
        <?php echo $array['copyright'] ?>
    </h5>
    <h5>Date:
        <?php echo $array['date'] ?>
    </h5>
    <p>
        <?php echo $array['explanation'] ?>
    </p>
</body>

</html>