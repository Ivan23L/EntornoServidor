<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );   
        require('../05_funciones/economia.php');
    ?>
    <style>
        .error{
            color: chocolate;
            font-style:italic;
        }
    </style>
</head>
<body>
    <!--
    GENERAL = 21%
    REDUCIDO = 10%
    SUPERREDUCIDO = 4%

    10€ IVA = GENERAL, PVP = 12,1€ PVP = precio * 1.21
    10€ iva = REDUCIDO, PVP = 11€  PVP = precio * 1.1
    -->
    <!-- CONVIERTO LOS ECHO ERRORES PRECIO EN UNA VARIABLE PARA MOSTRARLA EN EL FORMULARIO -->
    <?php                                                                                                                                   
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $precioTemporal = $_POST["precio"];
        if(isset($_POST["iva"])){
            $ivaTemporal = $_POST["iva"];
        }else{
            $ivaTemporal = "";
        }
        
        if($precioTemporal == '') {
            $errorPrecio = "El precio es obligatorio";
        } else {
            if(filter_var($precioTemporal, FILTER_VALIDATE_FLOAT) === FALSE) {
                $errorPrecio = "El precio debe ser un número";
            } else {
                if($precioTemporal < 0) {
                    $errorPrecio = "El precio debe ser mayor o igual que cero";
                } else {
                    $precio = $precioTemporal;
                }
            }
        }
        /* CONVIERTO LOS ECHO ERRORES PRECIO EN UNA VARIABLE PARA MOSTRARLA EN EL FORMULARIO */
        if($ivaTemporal == '') {
            $errorIva = "El IVA es obligatorio";
        } else {
            $valores_validos_iva = ["general", "reducido", "superreducido"];
            if(!in_array($ivaTemporal, $valores_validos_iva)) {
                $errorIva = "El IVA solo puede ser: general, reducido, superreducido";
            } else {
                $iva = $ivaTemporal;
            }
        }
    }
    ?>

    <form action="" method="post">
        <label for="precio">Precio</label>
        <input type="text" name="precio" id="precio">
        <!-- Si no se ha definido el precio -->
        <?php if(isset($errorPrecio)){
            echo "<span class= 'error'>$errorPrecio</span>";
        }
        ?>
        <br><br>
        <select name="iva">
            <!--
            disabled: no puede seleccionarse,
            selected: hace que sea la primera que va a aparecer,
            hidden: cuando se selecciona una opción esta va a desaparecer
            -->
            <option disabled selected hidden>--- Elige un tipo de IVA ---</option>
            <option value="general">General</option>
            <option value="reducido">Reducido</option>
            <option value="superreducido">Superreducido</option>
        </select>
        <?php if(isset($errorIva)){
            echo "<span class = 'error'>$errorIva</span>";
        }
        ?>
        <br><br>
        <input type="submit" value="Calcular">
    </form>

    <?php
        if(isset($precio) && isset($iva)) {
            echo "<h1>El PvP es " . calcularPVP($precio, $iva) . "</h1>";
        }
    ?>
    
</body>
</html>