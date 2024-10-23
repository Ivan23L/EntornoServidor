<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors",1);

        require('../05_funciones/potencias.php');
    ?>
</head>
<body>
    <form action="" method="post">

    <!-- CREAR UN FORMULARIO QUE RECIBA DOS PARÁMETROS: BASE Y EXPONENTE
    CUANDO SE ENVÍE EL FORMULARIO, SE CALCULARÁ EL RESULTADO DE ELEVAR LA BASE AL EXPONENTE    
    -->
    <label for="base">Base</label>
    <input type="text" name="base" id="base" placeholder="Introduce la base">

    <br>

    <label for="exponente">Exponente</label>
    <input type="text" name="exponente" id="exponente" placeholder="Introduce el exponente">

    <br>

    <input type="submit" value="Calcular">
    </form>

    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $baseTemporal = $_POST["base"];
    $exponenteTemporal = $_POST["exponente"];

        /*  ES LO MISMO QUE LO DE ABAJO DADO LA VUELTA 
        if($baseTemporal != ''){
            if(filter_var($baseTemporal, FILTER_VALIDATE_INT) !== false){
                $base = $baseTemporal;
            }else{
                echo "<p>La base debe ser un número</p>";
            }
        }else{
            echo "<p>La base es obligatoria amigo mío</p>";
        } */
        
        if($baseTemporal == ''){
            echo "<p>Escribe una base</p>";
        }else{
            //0 es falso amigo 
            if(filter_var($baseTemporal, FILTER_VALIDATE_INT) === false){
                echo "<p>La base debe ser un número entero</p>";
            }else{
                $base = $baseTemporal;
            }
        }


        /* 
        if($exponenteTemporal != ''){
            if(filter_var($exponenteTemporal, FILTER_VALIDATE_INT) !== false){
                $exponente = $exponenteTemporal;
            }else{
                echo "<p>El exponente debe ser un número mayor o igual que cero</p>";
            }
        }else{
            echo "<p>El exponente debe ser un número positivo</p>";
        }
        */

        if($exponenteTemporal == ''){
            echo "<p>Escribe un exponente amigo</p>";
        }else{
            if(filter_var($exponenteTemporal, FILTER_VALIDATE_INT) === false){
                echo "<p>El exponente debe ser un número entero</p>";
            }else{
                if($exponenteTemporal < 0){
                    echo "<p>El exponente debe ser un número mayor o igual que cero</p>";
                }else{
                    $exponente = $exponenteTemporal;
                }
                
            }
        }
        
        //is set (Si la variable ha sido definida anteriormente)
        if(isset($base) && isset($exponente)){

            $resultado = potencia($base, $exponente);
            echo "<h1>El resultado es $resultado</h1>";
        }
    }
    ?>

</body>
</html>