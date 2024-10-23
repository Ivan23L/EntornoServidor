<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        define("GENERAL", 1.21);
        define("REDUCIDO", 1.1);
        define("SUPERREDUCIDO", 1.04);
        require('../05_funciones/economia.php');
    ?>
</head>
<body>
    <!--
    GENERAL = 21%
    REDUCIDO = 10%
    SUPERREDUCIDO = 4%

    10€ IVA = GENERAL, PVP = 12,1€ PVP = precio * 1.21
    10€ iva = REDUCIDO, PVP = 11€  PVP = precio * 1.1
    -->
    <form action="" method="post">
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
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $precioTemporal = $_POST["precio"];
        $ivaTemporal = $_POST["iva"];

        if($precioTemporal == '') {
            echo "<p>El precio es obligatorio</p>";
        } else {
            if(filter_var($precioTemporal, FILTER_VALIDATE_FLOAT) === FALSE) {
                echo "<p>El precio debe ser un número</p>";
            } else {
                if($precioTemporal < 0) {
                    echo "<p>El precio debe ser mayor o igual que cero</p>";
                } else {
                    $precio = $precioTemporal;
                }
            }
        }

        if($ivaTemporal == '') {
            echo "<p>El IVA es obligatorio</p>";
        } else {
            $valores_validos_iva = ["general", "reducido", "superreducido"];
            if(!in_array($ivaTemporal, $valores_validos_iva)) {
                echo "<p>El IVA solo puede ser: general, reducido, superreducido</p>";
            } else {
                $iva = $ivaTemporal;
            }
        }

        if(isset($precio) && isset($iva)) {
            echo calcularPVP($precio, $iva);
        }

    }
    ?>
</body>
</html>