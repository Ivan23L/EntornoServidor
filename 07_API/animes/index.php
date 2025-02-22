<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estudios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <form action="" method="get">
        <label for="ciudad">Ciudad: </label>
        <input type="text" name="ciudad">
        <input type="submit" value="Buscar">
    </form>
    <?php
        //TIENES QUE CAMBIAR ESTA RUTA EN CASA Ó TE PETA AMIGO FIJATE EN LAS RUTAS
        $apiUrl = "http://localhost/ServidorWeb/Ejercicios1/07_API/animes/apiEstudios.php";
        
        if(isset($_GET["ciudad"]) and !empty($_GET["ciudad"])){
            $ciudad = $_GET["ciudad"];
            $apiUrl ="$apiUrl?ciudad=$ciudad";
        }

        $curl = curl_init();
        //Inicializamos el curl con una URL, que va a ser $apiUrl
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);// Para habilitar la transferencia de datos
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $estudios = json_decode($respuesta, true);
        //print_r($estudios);
    ?>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Estudio</th>
                <th>Ciudad</th>
                <th>Año de fundación</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($estudios as $estudio){ ?>
                    <tr>
                        <td><?php echo $estudio["nombre_estudio"]?></td>
                        <td><?php echo $estudio["ciudad"]?></td>
                        <td><?php echo $estudio["anno_fundacion"]?></td>
                    </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>