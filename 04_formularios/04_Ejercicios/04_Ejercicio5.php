<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 05</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h3>Ejercicio 05</h3>
    <br>

    <form action="" method="post">
        <label for="money">Cantidad: </label>
        <input type="text" name="money" id="money">
        <select name="original">
            <option value="euro">Euro</option>
            <option value="dolar">Dólar</option>
            <option value="yen">Yen</option>
        </select>
         a 
        <select name="conversion">
            <option value="dolar">Dólar</option>
            <option value="yen">Yen</option>
            <option value="euro">Euro</option>
        </select>
        <br><br>
        <input type="submit" value="Convertir">
    </form>

    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $dineros = $_POST["money"];
        $original = $_POST["original"];
        $conversion = $_POST["conversion"];
        $total = 0;
        echo "<br><br>";

        if ($original == $conversion) {
            echo "ERROR: La conversión es la misma.";
        } else {
            switch ($original) {
                case "euro":
                    if ($conversion == "yen") {
                        $total = $dineros * 162.48;
                    } else {
                        $total = $dineros * 1.09;
                    }
                    break;
                case "yen";
                    if ($conversion == "euro") {
                        $total = $dineros * 0.0062;
                    } else {
                        $total = $dineros * 0.0067;
                    }
                    break;
                case "dolar";
                    if ($conversion == "euro") {
                        $total = $dineros * 0.92;
                    } else{
                        $total = $dineros * 149.20;
                    }
                    break;
            }
            echo "<br><br>";
            echo "$dineros $original son $total $conversion";
        }

    }

    ?>

</body>
</html>