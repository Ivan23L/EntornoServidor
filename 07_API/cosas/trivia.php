<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trivia</title>
</head>

<body>
    <form action="" method="post">
        <label>Cantidad preguntas</label>
        <input type="text" name="cantidad">
        <select name="categoria">
            <option value="">Cualquiera</option>
            <option value="23">Historia</option>
            <option value="22">Geografia</option>
            <option value="27">Animales</option>
            <option value="15">Videojuegos</option>
        </select>
        <select name="dificultad">
            <option value="">Cualquiera</option>
            <option value="easy">Facil</option>
            <option value="medium">Normal</option>
            <option value="hard">Dificil</option>
        </select>
        <input type="submit" value="Buscar">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $cantidad = urlencode($_POST["cantidad"]);
        $categoria = $_POST["categoria"];
        $dificultad = $_POST["dificultad"];
        $apiUrl = "https://opentdb.com/api.php?amount=$cantidad&category=$categoria&difficulty=$dificultad";
        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        $array = json_decode($respuesta, true);
        $preguntas = $array["results"];
        
        foreach ($preguntas as $pregunta) {
            ?>
            <h3>
                <?php echo $pregunta['question'] ?>
            </h3>
            <p>Categoria: <?php echo $pregunta['category'] ?></p>
            <p>Dificultad: <?php echo $pregunta['difficulty'] ?></p>
            <ul>
                <li style="color: green;"><?php echo $pregunta['correct_answer'] ?></li>
                <?php
                   foreach ($pregunta['incorrect_answers'] as $incorrecta) {
                    ?>
                    <li style="color: red;"><?php echo $incorrecta ?></li>
                    <?php
                   }
                ?>
            </ul>
            <?php
        }
    }
    ?>
</body>

</html>