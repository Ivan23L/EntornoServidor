<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        define("GENERAL", 1.21);
        define("REDUCIDO", 1.1);
        define("SUPERREDUCIDO", 1.04);
    ?>
</head>
<body>
    <form action="" method="get">
        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio">
        <br><br>
        <select name="iva">
            <option value="general">General</option>
            <option value="reducido">Reducido</option>
            <option value="superreducido">Superreducido</option>
        </select>
        <br><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
    /* isset (is set) devuelve true si la variable existe */
    if(isset($_GET["precio"]) and isset($_GET["iva"])){
        $precio = $_GET["precio"];
        $iva = $_GET["iva"];


        if ($precio != "" and $iva != "") {
            $pvp = match($iva) {
                "general" => $precio * GENERAL,
                "reducido" => $precio * REDUCIDO,
                "superreducido" => $precio * SUPERREDUCIDO
            };

            echo "<p>El PVP ES $pvp</p>";

        } else {
            echo "<p>Faltan datos</p>";
        }

        
    }
    ?>
</body>
</html>